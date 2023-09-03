<?php

namespace victualler\customitems;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;

class EventHandler implements Listener {

    /**
     * @param PlayerJoinEvent $event
     */
    public function handleLogin(PlayerJoinEvent $event): void {
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