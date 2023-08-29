<?php

namespace victualler\customitems\ticks;

use pocketmine\scheduler\Task;
use victualler\customitems\session\Session;

class CooldownUpdate extends Task {

    protected ?Session $session;

    public function __construct(Session $session) {
        $this->session = $session;
    }

    public function onRun(): void
    {
        if(!$this->session->isOnline() && $this->session === null) {
            $this->getHandler()->cancel();
            return;
        }
        $this->session->onUpdate();
    }
}