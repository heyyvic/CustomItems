<?php

namespace victualler\customitems;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use victualler\customitems\commands\abilities\AbilitiesCommand;
use victualler\customitems\item\ItemLoader;
use victualler\customitems\provider\Provider;
use victualler\customitems\session\SessionFactory;

class Loader extends PluginBase {

    use SingletonTrait;

    private SessionFactory $sessionFactory;

    private Provider $provider;

    protected function onLoad(): void {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {
        $this->sessionFactory = new SessionFactory();
        $this->provider = new Provider();
        Loader::getInstance()->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);
        Loader::getInstance()->getServer()->getCommandMap()->register("CustomItems", new AbilitiesCommand());
        ItemLoader::init();
    }

    public function getSessionFactory(): SessionFactory {
        return $this->sessionFactory;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }
}