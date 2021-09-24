<?php

namespace App\Gameplay;

use App\Champions\Knight;
use App\Champions\Monster;

class Game
{
    /** @var Knight */
    protected $knight;

    /** @var Monster */
    protected $monster;

    /** @var string[] */
    protected $supportedGameModes;

    public function __construct(array $config)
    {
        if ($config['game']['modes']) {
            $gameModes = [];
            foreach ($config['game']['modes'] as $gameMode) {
                array_push($gameModes, $gameMode);
            }
            $this->supportedGameModes = $gameModes;
        }
    }

    /**
     * @return Knight
     */
    public function getKnight(): Knight
    {
        return $this->knight;
    }

    /**
     * @param Knight $knight
     * @return Game
     */
    public function setKnight(Knight $knight): Game
    {
        $this->knight = $knight;
        return $this;
    }

    /**
     * @return Monster
     */
    public function getMonster(): Monster
    {
        return $this->monster;
    }

    /**
     * @param Monster $monster
     * @return Game
     */
    public function setMonster(Monster $monster): Game
    {
        $this->monster = $monster;
        return $this;
    }
}