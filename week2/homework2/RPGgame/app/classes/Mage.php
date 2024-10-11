<?php

namespace App\classes;

use App\interfaces\MagicElixir;
use App\traits\Magic;

class Mage extends Character implements MagicElixir
{
    use Magic;
    public string $magic_item;
    public function __construct( string $name, float $health, float $attack_power,string $magic_item)
    {
        parent::__construct($name,$health, $attack_power);
        $this->magic_item = $magic_item;
    }
    function heal(float $health):float{
        return $this->health+=$health;
    }

}
