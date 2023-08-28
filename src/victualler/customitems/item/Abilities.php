<?php

namespace victualler\customitems\item;

use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\player\Player;

abstract class Abilities extends Item {

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);
    }

    public static function addEffects(Player $entity): void{
        foreach (self::getEffects() as $effect) {
            $entity->getEffects()->add($effect);
        }
    }
    public static function getEffects(): array {
        return [];
    }

    abstract function getDisplayName(): string;

    abstract function getDisplayLore(): string;

    abstract function getCooldown(): int;

}