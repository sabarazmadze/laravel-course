<?php

namespace App\Console\Commands;

use App\classes\Healer;
use App\classes\Mage;
use App\classes\Warrior;
use Illuminate\Console\Command;

class battle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simulate:battle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $warrior1 = new Warrior("Robin Hood",1230.1,190,"Longbow");
        $mage1 = new Mage("Hermione Granger", 1200, 100,"Grapevine Wood Wand 10¾ inches long");
        $healer1 = new Healer("Dr House",1359.2,120.5,45);

        $healer1->healPower();
        $healer1->receivedDamage($warrior1->attack_power);
//        dd($warrior1, $mage1, $healer1);
//        $this->comment("{$warrior1->getHealth()} is {$warrior1->getHealth() }");
        $counter = 1;
        $theWinner = "";
        while (($warrior1->getHealth() > 0) && ($mage1->getHealth() > 0)) {
            $this->comment("\nRound {$counter}\n");
            if($counter==3){
                $this->comment($mage1->messageAboutMaic());
                $this->comment($mage1->magicElixirOfHealth_200Hp());
                $mage1->heal(200);
            }
            if($counter==6){
                $this->comment($mage1->messageAboutMaic());
                $this->comment($mage1->magicElixirOfHealth_100Hp());
                $mage1->heal(100);
            }
            $warrior1->receivedDamage($mage1->attack_power);
            $mage1->receivedDamage($warrior1->attack_power);

            $warrior1 ->damageCounter($mage1->attack_power);
            $mage1 ->damageCounter($warrior1->attack_power);
            if($warrior1->getHealth() <0  ) {
                $this->comment("{$warrior1->name} was attaced by {$mage1->name} attaced,{$warrior1->name}'s dead now ");
                $theWinner=$mage1->name;
                break;
            }else if($mage1->getHealth()<0){
                $this->comment("{$mage1->name} was attaced by {$warrior1->name} attaced,{$mage1->name}'s dead now}");
                $theWinner=$warrior1->name;
                break;
            }
            else{
                $this->comment("{$warrior1->name} was attaced by {$mage1->name} attaced,{$warrior1->name}'s health is {$warrior1->getHealth()}");
                $this->comment("{$mage1->name} was attaced by {$warrior1->name} attaced,{$mage1->name}'s health is {$mage1->getHealth()}");
            }

            $counter++;
        }
        $this->comment("\nthe winner is {$theWinner},\ntotal number of rounds is {$counter}\n{$warrior1->name} gave {$mage1->damage_recived} hp damage\n{$mage1->name} gave {$warrior1->damage_recived} hp damage");
    }
}
