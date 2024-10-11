<?php

namespace App\classes;

class Warrior extends Character
{
    public string $weapon;
    public function __construct( string $name, float $health, float $attack_power,string $weapon)
    {
        parent::__construct($name,$health, $attack_power);
        $this->weapon = $weapon;
    }


}
