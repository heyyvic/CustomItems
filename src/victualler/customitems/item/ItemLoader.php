<?php

namespace victualler\customitems\item;

use Closure;
use victualler\customitems\item\presets\PotionRefill;
use victualler\customitems\item\presets\Resistance;
use victualler\customitems\item\presets\Strength;
use victualler\customitems\Loader;
use pocketmine\data\bedrock\item\ItemTypeNames;
use pocketmine\data\bedrock\item\SavedItemData;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\scheduler\AsyncTask;
use pocketmine\world\format\io\GlobalItemDataHandlers;

abstract class ItemLoader {

    public static function registerOnAllThreads(): void {
        $pool = Loader::getInstance()->getServer()->getAsyncPool();

        self::registerOnCurrentThread();
        $pool->addWorkerStartHook(function (int $worker) use ($pool): void {
            $pool->submitTaskToWorker(new class extends AsyncTask {
                public function onRun(): void {
                    ItemLoader::registerOnCurrentThread();
                }
            }, $worker);
        });
    }

    public static function registerOnCurrentThread(): void {
        self::registerItems();
    }

    private static function registerItems(): void {
        self::registerItem(ItemTypeNames::BLAZE_POWDER, new Strength(), ['blaze_powder']);
        self::registerItem(ItemTypeNames::GLASS_BOTTLE, new PotionRefill(), ['glass_bottle']);
        self::registerItem(ItemTypeNames::IRON_INGOT, new Resistance(), ['iron_ingot']);
    }

    private static function registerItem(string $id, Item $item, array $stringToItemParserNames, ?Closure $serializerCallback = null, ?Closure $deserializerCallback = null): void {
        $serializer = GlobalItemDataHandlers::getSerializer();
        $deserializer = GlobalItemDataHandlers::getDeserializer();

        (function () use ($id, $item, $serializerCallback): void {
            $this->itemSerializers[$item->getTypeId()] = $serializerCallback !== null ? $serializerCallback : static fn() => new SavedItemData($id);
        })->call($serializer);

        (function () use ($id, $item, $deserializerCallback): void {
            if (isset($this->deserializers[$id])) {
                unset($this->deserializers[$id]);
            }
            $this->map($id, $deserializerCallback !== null ? $deserializerCallback : static fn(SavedItemData $_) => clone $item);
        })->call($deserializer);

        foreach ($stringToItemParserNames as $name) {
            StringToItemParser::getInstance()->override($name, fn() => clone $item);
        }
    }
}