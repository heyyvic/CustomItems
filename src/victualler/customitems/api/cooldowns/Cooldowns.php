<?php
namespace victualler\customitems\api\cooldowns;

class Cooldowns{
    public static Cooldowns $instance;
    public function __construct()
    {
        self::$instance = $this;
    }
    public static function getInstance(): self{
        return self::$instance;
    }
    private array $cooldowns = [];
    private array $defaultTime = [];
	public function add(string $name, int $duration = 16, $item = "global") : void {
        $this->cooldowns[$item][strtolower($name)] = time();
        $this->defaultTime[$item][strtolower($name)] = $duration;
    }
    
    public function remove(string $name, $item) : void {
        if(isset($this->cooldowns[$item][strtolower($name)])) unset($this->cooldowns[strtolower($name)]);
        if(isset($this->defaultTime[$item][strtolower($name)])) unset($this->defaultTime[strtolower($name)]);
    }
    public function has(string $name, $item) : bool {
        $remaining = 0;
        if(isset($this->cooldowns[$item][strtolower($name)])) {
            $remaining = ($this->defaultTime[$item][strtolower($name)] - (time() - $this->cooldowns[$item][strtolower($name)]));
        }
        return $remaining > 0;
    }
    public function get(string $name, $item) : int {
        $remaining = 0;
        if(isset($this->cooldowns[$item][strtolower($name)])) {
            $remaining = ($this->defaultTime[$item][strtolower($name)] - (time() - $this->cooldowns[$item][strtolower($name)]));
        }
        return $remaining;
    }
    
    public function getAll() : array {
        return $this->cooldowns;
    }
}