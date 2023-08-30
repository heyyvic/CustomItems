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
        $this->setCustomName(TextFormat::colorize("&r".$this->getDisplayName()));
        $this->setLore([$this->getDisplayLore()]);
        $this->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
    }

    public function addEffects(array $effects, Player $entity): void {
        foreach ($effects as $effect) {
            $entity->getEffects()->add($effect);
        }
    }
    
    abstract function getEffects(): array;

    public function getDuration(): int {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['duration'];
    }

    public function getAmplifier(): int {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['amplifier'];
    }

    public function getDisplayName(): string {
        return TextFormat::colorize("&r".Loader::getInstance()->getConfig()->get("{$this->getName()}")['custom-name']);
    }

    public function getDisplayLore(): string {
        return TextFormat::colorize(str_replace(['{cooldown}', '{duration}'], [$this->getCooldown(), $this->getDuration()], "&r".Loader::getInstance()->getConfig()->get("{$this->getName()}")['custom-lore']));
    }

    public function getCooldown(): int {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['cooldown'];
    }
}
