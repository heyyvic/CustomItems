<?php

namespace victualler\customitems\item\presets;

use pocketmine\item\ItemIdentifier;
use victualler\customitems\item\Abilities;
use victualler\customitems\Loader;

class Strength extends Abilities {

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);
    }

    public function getDisplayName(): string
    {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['custom-name'];
    }

    public function getDisplayLore(): string
    {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['custom-lore'];
    }

    public function getCooldown(): int
    {
        return Loader::getInstance()->getConfig()->get("{$this->getName()}")['cooldown'];
    }
}