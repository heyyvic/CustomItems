<?php

namespace victualler\customitems\session\cooldown;
class Cooldown {

    /** @var string */
    private string $format;
    /** @var int */
    private int $time;

    /**
     * Cooldown construct.
     * @param string $format
     * @param int $time
     */
    public function __construct(string $format, int $time) {
        $this->format = $format;
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getFormat(): string {
        return $this->format;
    }

    /**
     * @return int
     */
    public function getTime(): int {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime(int $time): void {
        $this->time = $time;
    }

    public function update(): void
    {
        $this->time--;
    }
}