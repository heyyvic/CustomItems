<?php

namespace victualler\customitems\item\presets;

use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use victualler\customitems\item\Abilities;
use victualler\customitems\Loader;
use victualler\customitems\session\SessionFactory;

class Strength extends Abilities {

    public function __construct()
    {
        parent::__construct(new ItemIdentifier(ItemTypeIds::BLAZE_POWDER), "strength");
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        $session = SessionFactory::getInstance()->getSession($player->getXuid());
        if(($cooldown = $session->getCooldown("partner.cooldown")) !== null) {
            $this->getMessageForCooldown("global-message-hasCooldown", $cooldown);
            return ItemUseResult::FAIL();
        }
        if(($cooldown = $session->getCooldown("strength.cooldown")) !== null) {
            $this->getMessageForCooldown("pitem-message-hasCooldown", $cooldown);
            return ItemUseResult::FAIL();
        }
        $session->addCooldown("partner.cooldown", $this->getFormatGlobal(), $this->getCooldownGlobal());
        $session->addCooldown("strength.cooldown", $this->getFormat(), $this->getCooldown());
        $player->sendMessage($this->getMessageForItem("strength-message-use"));
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