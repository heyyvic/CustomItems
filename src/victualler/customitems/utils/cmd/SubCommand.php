<?php

namespace victualler\customitems\utils\cmd;

use pocketmine\command\CommandSender;

abstract class SubCommand {

    /**
     * SubCommand Constructor.
     * @param string $name
     * @param string $usage
     * @param array $aliases
     */
    public function __construct(
        protected string $name,
        protected string $usage,
        protected array $aliases,
    ){}

    /**
     * @return string
     */
    public function getName() : string {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getUsage() : ?string {
        return $this->usage;
    }

    /**
     * @return array
     */
    public function getAliases() : array {
        return $this->aliases;
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return void
     */
    abstract public function execute(CommandSender $sender, string $commandLabel, array $args) : void;
}

?>