<?php

namespace victualler\customitems\item\trait;

use victualler\customitems\api\cooldowns\Cooldowns;
use pocketmine\utils\Config;

trait MessageTrait {

    public function getMessageForItem(String $string, String $name): String {
        $config = new Config("messages.yml", Config::YAML);
        return str_replace(['{displayName}', '{displayLore}', '{cooldown}', '{amplifier}', '{duration}'], [$this->getDisplayName($name), $this->getDisplayLore($name), $this->getCooldown($name), $this->getAmplifier($name), $this->getDuration($name)], $config->get($string));
    }

    public function getMessageForCooldown(String $string, String $time, String $format): String {
        $config = new Config("messages.yml", Config::YAML);
        return str_replace(['{time}', '{format}'], [$time, $format], $config->get($string));
    }
}