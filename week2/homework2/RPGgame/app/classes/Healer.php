<?php

namespace App\classes;

use App\interfaces\MagicElixir;
use App\traits\Magic;

class Healer extends Character implements MagicElixir
{
    use Magic;
    public float $healPower;
    public function __construct( string $name, float $health, float $attack_power,float $healPower)
    {
        parent::__construct($name,$health, $attack_power);
        $this->healPower = $healPower;
    }

    public  function healPower():void
    {
        $this->health += $this->healPower;
    }

    function heal(float $health):float{
        return $this->health+=$health;
    }
}
