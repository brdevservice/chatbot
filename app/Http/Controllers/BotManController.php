<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;

class BotManController extends Controller
{
    public $botman;
    public $name;

    public function handle()
    {

        $this -> botman = app('botman');
        $botman = $this -> botman;
        $botman->hears('{message}', function($botman, $message) {

            if ($message == 'inicio') {
                $this->askName($botman);
            }else{
                $botman->reply("Por favor, escribe 'inicio' para comenzar");
            }

        });

        $botman->listen();
    }

    public function askName($botman)
    {
        $this -> botman = app('botman');
        $botman = $this -> botman;
        $botman->ask('Hola, ¿Podrías indicarme tu nombre?', function(Answer $answer) {

            $name = $answer->getText();
            $this -> name = $name;

            $this->say('Mucho gusto, ' . $name);

            $this -> askAge();
        });
        $botman->listen();
    }

    public function askAge()
    {
        $this -> botman = app('botman');
        $botman = $this -> botman;
        $botman->ask($this -> name . ', ¿Podrías indicarme tu nombre?', function(Answer $answer) {

            $age = $answer->getText();

            $this->say('Entonces tienes, ' . $age);

        });
    }

}
