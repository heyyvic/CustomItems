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
use victualler\customitems\Loader;

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
            $item = new Strength();
            $item->setCustomName($item->getDisplayName($item->getVanillaName()));
            $item->setLore([$item->getDisplayLore($item->getVanillaName())]);
            $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::PROTECTION(), 1));
            if($sender->getInventory()->canAddItem($item)) {
                $sender->getInventory()->addItem($item);
            } else {
                $sender->dropItem($item);
            }
            return;
        }

        switch ($args[0]) {
            case "getcooldown":
                $session = Loader::getInstance()->getSessionFactory()->getSession($sender->getXuid());
                if(count($session->getCooldowns()) <= 0) {
                    $sender->sendMessage("No cooldowns actives");
                    return;
                }
                foreach ($session->getCooldowns() as $name => $cooldown)
                    $sender->sendMessage(TextFormat::colorize("&e$name&r &ais active. &7Format&c: ".$cooldown->getFormat()."&r&7Time&c: &8".$cooldown->getFormat()));
                break;
            default:
                $sender->sendMessage("No options: (getcooldown)");
        }
    }

}