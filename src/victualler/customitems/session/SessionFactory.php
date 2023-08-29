<?php

declare(strict_types=1);

namespace victualler\customitems\session;

use pocketmine\utils\SingletonTrait;
use victualler\customitems\Loader;
use victualler\customitems\session\Session;

class SessionFactory {

    use SingletonTrait;

    /** @var Session[] */
    private array $sessions = [];


    public function __construct()
    {
        foreach (Loader::getInstance()->getProvider()->getPlayers() as $xuid => $data)
            $this->addSession((string) $xuid, $data);
    }

    /**
     * @return array
     */
    public function getSessions(): array
    {
        return $this->sessions;
    }

    /**
     * @param string $xuid
     * @return Session|null
     */
    public function getSession(string $xuid): ?Session
    {
        return $this->sessions[$xuid] ?? null;
    }

    /**
     * @param string $xuid
     * @param array $data
     */
    public function addSession(string $xuid, array $data): void {
        $this->sessions[$xuid] = new Session($xuid, $data);
    }
}