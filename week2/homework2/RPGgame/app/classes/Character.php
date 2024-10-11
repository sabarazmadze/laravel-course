<?php

namespace App\classes;

class Character
{
    public string $name;
    protected float $health;
    public float $attack_power;
    public float $damage_recived=0;

    public function __construct( string $name, float $health, float $attack_power, float $damage_recived=0)
    {
        $this->name = $name;
        $this->health = $health;
        $this->attack_power = $attack_power;
        $this->damage_recived =0;
    }

    public function receivedDamage(float $damage):void{
        $this->health -= $damage;
    }

    public function getHealth():float
    {
        return $this->health;
    }
    public function damageCounter($valuable):void
    {
        $this->damage_recived += $valuable;
    }
}
