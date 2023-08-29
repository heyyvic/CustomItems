<?php

namespace victualler\customitems\commands\abilities;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class AbilitiesCommand extends Command {

    public function __construct()
    {
        parent::__construct("abilities", "", "", []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

    }

}