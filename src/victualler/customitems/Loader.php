<?php

namespace victualler\customitems;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class Loader extends PluginBase {

    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }
}