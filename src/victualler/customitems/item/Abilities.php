<?php

namespace victualler\customitems\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use victualler\customitems\Loader;

abstract class Abilities extends Item {

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);
    }

    public function addEffects(Player $entity): void{
        foreach (self::getEffects() as $effect) {
            $entity->getEffects()->add($effect);
        }
    }
    abstract static function getEffects(): array ;

    public function getDuration(): int
    {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['amplifier'];
    }

    public function getAmplifier(): int {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['amplifier'];
    }

    public function getDisplayName(): string {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['custom-name'];
    }

    public function getDisplayLore(): string {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['custom-lore'];
    }

    public function getCooldown(): int {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['cooldown'];
    }

}