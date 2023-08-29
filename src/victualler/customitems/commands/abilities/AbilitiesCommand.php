<?php

namespace victualler\customitems\commands\abilities;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
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
        if($sender->getInventory()->canAddItem(new Strength())) {
            $sender->getInventory()->addItem(new Strength());
        } else {
            $sender->dropItem(new Strength());
        }
    }

}