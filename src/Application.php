<?php

namespace App;

use App\Champions\Builder\ChampionBuilder;
use App\Champions\Builder\Director;
use App\Champions\Champion;
use App\Gameplay\Game;
use Exception;

class Application {

    /** @var mixed */
    protected $config;

    /** @var Game */
    protected $game;

    /** @var Champion[] */
    protected $knights;

    /** @var Champion[] */
    protected $monsters;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->config = include('config.php');
    }

    public function bootstrap():void
    {
    }

    /**
     * @throws Exception
     */
    protected function initChampions(): void
    {
        $knightsSetting = $this->config['champions'];
        $director = new Director();

        foreach ($knightsSetting as $knightSettings) {
            $director->build(
                new ChampionBuilder()
            );
        }
    }

}