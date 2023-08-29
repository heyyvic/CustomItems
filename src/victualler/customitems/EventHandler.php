<?php

namespace victualler\customitems;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use victualler\customitems\session\SessionFactory;
use victualler\customitems\ticks\CooldownUpdate;

class EventHandler implements Listener {

    /**
     * @param PlayerJoinEvent $event
     * @return void
     * @priority HIGH
     */
    public function handleJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $session = SessionFactory::getInstance()->getSession($player->getXuid());

        if($session === null) {
            return;
        }

        Loader::getInstance()->getScheduler()->scheduleRepeatingTask(new CooldownUpdate($session), 20);
    }

    /**
     * @param PlayerLoginEvent $event
     * @return void
     * @priority HIGH
     */
    public function handleLogin(PlayerLoginEvent $event): void {
        $player = $event->getPlayer();
        $session = Loader::getInstance()->getSessionFactory()->getSession($player->getXuid());

        if ($session === null)
            Loader::getInstance()->getSessionFactory()->addSession($player->getXuid(), [
                'name' => $player->getName(),
                'cooldowns' => []
            ]);
        else {
            if ($player->getName() !== $session->getName())
                $session->setName($player->getName());
        }
    }

}