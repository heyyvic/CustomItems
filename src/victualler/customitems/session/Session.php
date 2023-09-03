<?php

namespace victualler\customitems\session;
use pocketmine\Server;
use victualler\customitems\session\cooldown\Cooldown;

class Session {

    /** @var string */
    private string $xuid;

    /** @var Cooldown[] */
    private array $cooldowns = [];

    private string $name;

    /**
     * Session construct.
     * @param string $xuid
     * @param array $data
     */
    public function __construct(string $xuid, array $data) {
        $this->xuid = $xuid;
        $this->name = $data['name'];

        foreach ($data['cooldowns'] as $key => $cooldown)
            $this->addCooldown($key, $cooldown['format'], (int) $cooldown['time']);
    }

    /**
     * @return string
     */
    public function getXuid(): string {
        return $this->xuid;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return Cooldown[]
     */
    public function getCooldowns(): array {
        return $this->cooldowns;
    }

    /**
     * @param string $key
     * @return Cooldown|null
     */
    public function getCooldown(string $key): ?Cooldown {
        return $this->cooldowns[$key] ?? null;
    }

    /**
     * @return bool
     */
    public function isOnline(): bool {
        $player = Server::getInstance()->getPlayerExact($this->getName());

        return $player !== null;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @param string $key
     * @param string $format
     * @param int $time
     */
    public function addCooldown(string $key, string $format, int $time): void {
        $this->cooldowns[$key] = new Cooldown($format, $time);
    }

    /**
     * @param string $key
     */
    public function removeCooldown(string $key): void {
        unset($this->cooldowns[$key]);
    }

    public function onUpdate(): void {
        foreach ($this->getCooldowns() as $key => $cooldown) {
            $cooldown->update();

            if ($cooldown->getTime() <= 0)
                $this->removeCooldown($key);
        }
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $data = [
            'name' => $this->getName(),
            'cooldowns' => []
        ];

        foreach ($this->getCooldowns() as $key => $cooldown)
            $data['cooldowns'][$key] = [
                'format' => $cooldown->getFormat(),
                'time' => $cooldown->getTime(),
            ];
        return $data;
    }
}