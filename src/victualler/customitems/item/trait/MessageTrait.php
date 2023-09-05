<?php

namespace victualler\customitems\item\trait;

use victualler\customitems\api\cooldowns\Cooldowns;
use pocketmine\utils\Config;
use victualler\customitems\Loader;

trait MessageTrait {

    public function getMessageForItem(String $string, String $name): String {
        $config = Loader::getInstance()->getConfig();
        return str_replace(['{displayName}', '{displayLore}', '{cooldown}', '{amplifier}', '{duration}'], [$this->getDisplayName($name), $this->getDisplayLore($name), $this->getCooldown($name), $this->getAmplifier($name), $this->getDuration($name)], $config->get($string));
    }

    public function getMessageForCooldown(String $string, String $time, String $format): String {
        $config = Loader::getInstance()->getConfig();
        return str_replace(['{time}', '{format}'], [$time, $format], $config->get($string));
    }
}