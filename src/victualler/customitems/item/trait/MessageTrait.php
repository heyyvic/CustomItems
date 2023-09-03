<?php

namespace victualler\customitems\item\trait;

use pocketmine\utils\Config;
use victualler\customitems\session\cooldown\Cooldown;

trait MessageTrait {

    public function getMessageForItem(String $string, String $name): String {
        $config = new Config("messages.yml", Config::YAML);
        return str_replace(['{displayName}', '{displayLore}', '{cooldown}', '{amplifier}', '{duration}'], [$this->getDisplayName($name), $this->getDisplayLore($name), $this->getCooldown($name), $this->getAmplifier($name), $this->getDuration($name)], $config->get($string));
    }

    public function getMessageForCooldown(String $string, Cooldown $cooldown): String {
        $config = new Config("messages.yml", Config::YAML);
        return str_replace(['{format}', '{time}'], [$cooldown->getFormat(), $cooldown->getTime()], $config->get($string));
    }
}