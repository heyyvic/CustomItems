<?php

namespace victualler\customitems;

use victualler\customitems\api\cooldowns\Cooldowns;
use victualler\customitems\commands\abilities\AbilitiesCommand;
use victualler\customitems\item\ItemLoader;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase {

    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable(): void {
        new Cooldowns();
        $this->getServer()->getCommandMap()->register("CustomItems", new AbilitiesCommand());
        $this->registerItems();
    }

    private function registerItems(): void {
        ItemLoader::registerOnAllThreads();
    }
}
