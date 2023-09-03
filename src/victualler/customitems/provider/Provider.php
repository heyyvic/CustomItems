<?php

namespace victualler\customitems\provider;

use JsonException;
use pocketmine\utils\Config;
use victualler\customitems\Loader;

class Provider {

    public function __construct() {
        $plugin = Loader::getInstance();

        if (!is_dir($plugin->getDataFolder() . 'database'))
            @mkdir($plugin->getDataFolder() . 'database');
        if (!is_dir($plugin->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players'))
            @mkdir($plugin->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players');

        $plugin->saveDefaultConfig();
    }

    /**
     * @throws JsonException
     */
    public function save(): void {
        $this->savePlayers();
    }
    /**
     * @return array
     */
    public function getPlayers(): array {
        $players = [];

        foreach (glob(Loader::getInstance()->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players' . DIRECTORY_SEPARATOR . '*.yml') as $file)
            $players[basename($file, '.yml')] = (new Config(Loader::getInstance()->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players' . DIRECTORY_SEPARATOR . basename($file), Config::YAML))->getAll();
        return $players;
    }

    /**
     * @throws JsonException
     */
    public function savePlayers(): void {
        foreach (Loader::getInstance()->getSessionFactory()->getSessions() as $xuid => $session) {
            $config = new Config(Loader::getInstance()->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players' . DIRECTORY_SEPARATOR  . $xuid . '.yml', Config::YAML);
            $config->setAll($session->getData());
            $config->save();
        }
    }
}