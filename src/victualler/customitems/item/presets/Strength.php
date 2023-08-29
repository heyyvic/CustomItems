<?php

namespace victualler\customitems\item\presets;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use victualler\customitems\item\Abilities;
use victualler\customitems\Loader;

class Strength extends Abilities {

    public function __construct(ItemIdentifier $identifier, string $name)
    {
        parent::__construct($identifier, $name);
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $player->sendMessage($this->getMessage("strength-message-use"));
        self::addEffects($this->getEffects(), $player);
        return ItemUseResult::SUCCESS();
    }

    /**
     * @return EffectInstance[]
     */
    public function getEffects(): array {
        return [new EffectInstance(VanillaEffects::STRENGTH(), 20*$this->getDuration(), $this->getAmplifier())];
    }
}