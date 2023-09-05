<?php

namespace victualler\customitems\item\presets;

use pocketmine\utils\TextFormat;
use victualler\customitems\item\Abilities;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;

class Resistance extends Abilities {

    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemTypeIds::IRON_INGOT), "resistance");
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult {
        if($this->hasCooldownGlobalItem($player)) {
            $player->sendMessage(TextFormat::colorize($this->getMessageForCooldown("global-message-hasCooldown", $this->getCooldownGlobalItem($player), $this->getFormatGlobal())));
            return ItemUseResult::FAIL();
        }
        if($this->hasCooldownItem($player, $this)) {
            $player->sendMessage(TextFormat::colorize($this->getMessageForCooldown($this->getVanillaName()."-message-hasCooldown", $this->getCooldownItem($player, $this), $this->getCustomName())));
        }
        $player->sendMessage($this->getMessageForItem($this->getVanillaName()."-message-use", $this->getVanillaName()));
        self::addEffects($this->getEffects(), $player);
        $this->addCooldownGlobalItem($player, $this);
        $this->addCooldownItem($player, $this);
        $this->pop();
        return ItemUseResult::SUCCESS();
    }

    /**
     * @return EffectInstance[]
     */
    public function getEffects(): array {
        return [new EffectInstance(VanillaEffects::RESISTANCE(), 20*$this->getDuration($this->getVanillaName()), $this->getAmplifier($this->getVanillaName()))];
    }
}