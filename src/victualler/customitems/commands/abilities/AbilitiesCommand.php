<?php

namespace victualler\customitems\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use victualler\customitems\item\presets\Strength;

class AbilitiesCommand extends Command {

    public function __construct()
    {
        parent::__construct("abilities", "", "", []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        new Strength()->getDisp
    }

}