<?php

namespace victualler\customitems\provider;

use JsonException;
use pocketmine\utils\Config;
use victualler\customitems\Loader;

class Provider {

    public function __construct() {
        $plugin = Loader::getInstance();

        if (!is_dir($plugin->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players'))
            @mkdir($plugin->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players');

        $plugin->saveDefaultConfig();
    }

    /**
     * @throws JsonException
     */
    public function save(): void
    {
        $this->savePlayers();
    }
    /**
     * @return array
     */
    public function getPlayers(): array {
        $players = [];

        foreach (glob(Loader::getInstance()->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players' . DIRECTORY_SEPARATOR . '*.json') as $file)
            $players[basename($file, '.json')] = (new Config(Loader::getInstance()->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players' . DIRECTORY_SEPARATOR . basename($file), Config::JSON))->getAll();
        return $players;
    }

    /**
     * @throws JsonException
     */
    public function savePlayers(): void {
        foreach (Loader::getInstance()->getSessionFactory()->getSessions() as $xuid => $session) {
            $config = new Config(Loader::getInstance()->getDataFolder() . 'database' . DIRECTORY_SEPARATOR . 'players' . DIRECTORY_SEPARATOR  . $xuid . '.json', Config::JSON);
            $config->setAll($session->getData());
            $config->save();
        }
    }
}