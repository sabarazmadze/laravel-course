<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
class hangMan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play:hangman';

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

        $winner=false;
        $word = $this->ask('what word do you want opponent to guess?');
        $this->comment('hi player, player1 think of word, now it is your turn to guess letters.');

        file_put_contents(storage_path('logs/hangman.log'),  "\n|{$word}:", FILE_APPEND | LOCK_EX);

        $counter=0;
        $prevword="";
        while ($winner==false) {


            //          ask user about letter in word
            $letter = $this->ask('what letter is in the word?');

            //          check if user already used this letter ask user to enter another letter
            $allData = file_get_contents(storage_path('logs/hangman.log'));
            $possitionOFTwoDots=strripos($allData,":", -1);
            $fileLetters = substr($allData,$possitionOFTwoDots+1);

            while (strlen(str_replace($letter, "", $fileLetters))!==strlen($fileLetters)){
                $letter = $this->ask('you have already said this letter, try different one');
            }

            //          get letters
            file_put_contents(storage_path('logs/hangman.log'),  $letter, FILE_APPEND | LOCK_EX);
            $allData = file_get_contents(storage_path('logs/hangman.log'));
            $possitionOFTwoDots =strripos($allData,":", -1);
            $fileLetters = substr($allData,$possitionOFTwoDots+1);
            //          get last word
            $possitionOfLastWord =strripos($allData,"|", -1)+1;
            $hiddenWordBeforeEditing=$hiddenWord=substr($allData, $possitionOfLastWord, $possitionOFTwoDots-$possitionOfLastWord);;
            //          check if a user found a new letter
            $letterFoundOnThisTurn=false;

            //          hide all letters which user found
            for($i=0; $i<strlen($hiddenWord); $i++) {
               for ($j=0; $j<strlen($fileLetters); $j++) {
                    if($hiddenWord[$i]!==$fileLetters[$j]){
                        $hiddenWord=str_replace($fileLetters[$j], "_", $hiddenWord);
                    }
               }
            }
            $fullword="";
            //          hide all letters which user did not find
            for($i=0; $i<strlen($hiddenWord); $i++) {
                if($hiddenWord[$i]==="_"){
                    $fullword .=$hiddenWordBeforeEditing[$i];
                }else{
                    $fullword .= "-";
                }


            }

            //          chech if user found new letter
            if($prevword!==$fullword){
                $letterFoundOnThisTurn=true;
            }
           $prevword=$fullword;

            $triesLeft=5-$counter;
            //          if user found right word give this message
            if($letterFoundOnThisTurn===true){
                $this->comment("letter {$letter} is in the word,you have {$triesLeft} more  tries \nnow word looks like this :{$fullword}");
            }else{
            //          if user did not find a letter decrease tries before loosing
                $triesLeft-=1;
                $this->comment("letter {$letter} was not in the word,you have {$triesLeft}  more tries  \nnow word looks like this :{$fullword}");
                $counter++;
            }
            //          check if user won
            if($fullword===$word){
                $this->comment("congratulations, you won! \nthe word was {$word}");
                break;
            }
            //          check if user wrong letters are greater than 5, give loosing message
            if($counter>=5){
                $this->comment("unfortunatelly, you lost! \nthe word was {$word}");
                break;
            }

        }

        $again = $this->ask('do ypu want to play again?(n/y)');
        if($again=="y") {
            Artisan::call('play:hangman');
        }
    }
}
