<?php

namespace victualler\customitems;

use JsonException;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
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

    protected function onEnable(): void {
        $this->provider = new Provider();

        $this->sessionFactory = new SessionFactory();
        
        $this->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);

        $this->getServer()->getCommandMap()->register("CustomItems", new AbilitiesCommand());
        ItemLoader::init();

        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
            foreach ($this->getSessionFactory()->getSessions() as $session) $session->onUpdate();
        }), 20);
    }

    /**
     * @throws JsonException
     */
    protected function onDisable(): void {
        if (isset($this->provider)) $this->provider->save();
    }

    public function getProvider(): Provider {
        return $this->provider;
    }

    public function getSessionFactory(): SessionFactory {
        return $this->sessionFactory;
    }
}
