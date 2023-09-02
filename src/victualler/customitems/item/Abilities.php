<?php

namespace victualler\customitems\item;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use pocketmine\utils\TextFormat;
use victualler\customitems\Loader;
use victualler\customitems\item\trait\MessageTrait;

abstract class Abilities extends Item {

    use SingletonTrait;
    use MessageTrait;

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name) {
        parent::__construct($identifier, $name);
    }

    public function addEffects(array $effects, Player $entity): void {
        foreach ($effects as $effect) {
            $entity->getEffects()->add($effect);
        }
    }
    
    abstract function getEffects(): array;

    public function getDuration(String $name): int {
        return intval(Loader::getInstance()->getConfig()->get($name)['duration']);
    }

    public function getAmplifier(String $name): int {
        return intval(Loader::getInstance()->getConfig()->get($name)['amplifier']);
    }

    public function getDisplayName(String $name): string {
        return TextFormat::colorize("&r".Loader::getInstance()->getConfig()->get($name)['custom-name']);
    }

    public function getDisplayLore(String $name): string {
        return TextFormat::colorize(str_replace(['{cooldown}', '{duration}'], [$this->getCooldown($name), $this->getDuration($name)], "&r".Loader::getInstance()->getConfig()->get($name)['custom-lore']));
    }

    public function getCooldown(String $name): int {
        return intval(Loader::getInstance()->getConfig()->get($name)['cooldown']);
    }

    public function getFormat(String $name): int {
        return Loader::getInstance()->getConfig()->get($name)['format'];
    }

    public function getCooldownGlobal(): int {
        return intval(Loader::getInstance()->getConfig()->get("global")['cooldown-global-ability']);
    }

    public function getFormatGlobal(): string {
        return Loader::getInstance()->getConfig()->get("global")['format-global-ability'];
    }
}
