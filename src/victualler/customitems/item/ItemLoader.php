<?php

namespace victualler\customitems\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\utils\CloningRegistryTrait;
use victualler\customitems\item\presets\Strength;

abstract class ItemLoader {

    use CloningRegistryTrait;

    protected static function register(string $name, Item $item) : void {
        self::_registryRegister($name, $item);
    }

    public static function init(): void {
        self::register("strength", new Strength());
    }
}