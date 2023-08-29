<?php

namespace victualler\customitems\item\trait;

use pocketmine\utils\Config;
use victualler\customitems\session\cooldown\Cooldown;

trait MessageTrait {

    public function getMessageForItem(String $string): String {
        $config = new Config("messages.yml", Config::YAML);
        return $config->get(str_replace(['{displayName}', '{displayLore}', '{cooldown}', '{amplifier}', '{duration}'], [$this->getDisplayName(), $this->getDisplayLore(), $this->getCooldown(), $this->getAmplifier(), $this->getDuration()], $string));
    }

    public function getMessageForCooldown(String $string, Cooldown $cooldown): String {
        $config = new Config("messages.yml", Config::YAML);
        return $config->get(str_replace(['{format}', '{time}'], [$cooldown->getFormat(), $cooldown->getTime()], $string));
    }
}