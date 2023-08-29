<?php

namespace victualler\customitems\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;
use pocketmine\utils\SingletonTrait;
use victualler\customitems\Loader;
use victualler\customitems\item\trait\MessageTrait;

abstract class Abilities extends Item {

    use SingletonTrait;
    use MessageTrait;

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);
    }

    public function addEffects(array $effects, Player $entity): void{
        foreach ($effects as $effect) {
            $entity->getEffects()->add($effect);
        }
    }
    abstract function getEffects(): array ;

    public function getDuration(): int
    {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['duration'];
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