<?php

namespace victualler\customitems\commands\abilities;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use victualler\customitems\item\Abilities;
use victualler\customitems\item\presets\Strength;

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
        $item = new Strength();
        $item->setCustomName($item->getDisplayName($item->getName()));
        $item->setLore([$item->getDisplayLore($item->getName())]);
        $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
        if($sender->getInventory()->canAddItem($item)) {
            $sender->getInventory()->addItem($item);
        } else {
            $sender->dropItem($item);
        }
    }

}