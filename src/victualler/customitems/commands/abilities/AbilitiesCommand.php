<?php

namespace victualler\customitems\commands\abilities;

use victualler\customitems\item\Abilities;
use victualler\customitems\item\presets\PotionRefill;
use victualler\customitems\item\presets\Resistance;
use victualler\customitems\item\presets\Strength;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class AbilitiesCommand extends Command {

    public function __construct()
    {
        parent::__construct("abilities");
        $this->setPermissions(["abilities.command"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void {
        if(!$this->testPermission($sender) || !($sender instanceof Player)) {
            $sender->sendMessage(TextFormat::colorize("&cYou do not have permissions to use this command."));
            return;
        }
        if(empty($args)) {
            foreach ([new Strength(), new PotionRefill(), new Resistance()] as $item) {
                $item->setCustomName($item->getDisplayName($item->getVanillaName()));
                $item->setLore([$item->getDisplayLore($item->getVanillaName())]);
                $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
                if($item instanceof Abilities) {
                    $item->getNamedTag()->setString($item::ntb, $item->getVanillaName());
                }
                if ($sender->getInventory()->canAddItem($item)) {
                    $sender->getInventory()->addItem($item);
                } else {
                    $sender->dropItem($item);
                }
            }
        }
    }

}