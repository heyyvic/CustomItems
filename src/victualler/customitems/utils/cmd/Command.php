<?php

namespace victualler\customitems\utils\cmd;

use pocketmine\command\{Command as PMMPCommand, CommandSender};

abstract class Command extends PMMPCommand {

    /** @var array */
    protected array $subCommands;

    /**
     * Command Constructor.
     * @param string $name
     * @param string $description
     * @param string $usage
     * @param array $alias
     */
    public function __construct(string $name, string $description, string $usage, array $alias){
        parent::__construct($name, $description, $usage, $alias);
    }

    /**
     * @param SubCommand $subCommand
     * @return void
     */
    public function addSubCommand(SubCommand $subCommand) : void {
        $this->subCommands[$subCommand->getName()] = $subCommand;
        foreach($subCommand->getAliases() as $alias){
            $this->subCommands[$alias] = $subCommand;
        }
    }

    /**
     * @param string $name
     * @return SubCommand|null
     */
    public function getSubCommand(string $name) : ?SubCommand {
        return $this->subCommands[$name] ?? null;
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