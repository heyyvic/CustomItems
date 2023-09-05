<?php

namespace victualler\customitems\item\trait;

use victualler\customitems\api\cooldowns\Cooldowns;
use victualler\customitems\item\Abilities;
use pocketmine\player\Player;
use victualler\customitems\utils\Time;

trait CooldownTrait {

    public function addCooldownItem(Player $player, Abilities $ability) : void {
        Cooldowns::getInstance()->add($player->getName(), $ability->getCooldown($player->getName()), $ability->getVanillaName());
    }

    public function addCooldownGlobalItem(Player $player, Abilities $ability) : void {
        Cooldowns::getInstance()->add($player->getName(), $ability->getCooldownGlobal());
    }

    public function hasCooldownItem(Player $player, Abilities $ability): bool {
        return Cooldowns::getInstance()->has($player->getName(), $ability->getVanillaName());
    }

    public function hasCooldownGlobalItem(Player $player): bool {
        return Cooldowns::getInstance()->has($player->getName(), "global");
    }

    public function getCooldownItem(Player $player, Abilities $ability): string {
        return Time::getTimeToString(Cooldowns::getInstance()->get($player->getName(), $ability->getVanillaName()));
    }

    public function getCooldownGlobalItem(Player $player): string {
        return Time::getTimeToString(Cooldowns::getInstance()->get($player->getName(), "global"));
    }
}