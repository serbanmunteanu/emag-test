<?php

namespace App\Gameplay;

use App\Champions\AbstractChampion;
use Exception;

class Game
{
    /** @var AbstractChampion */
    protected $knight;

    /** @var AbstractChampion */
    protected $monster;

    /** @var int  */
    protected $round = 0;

    /** @var int */
    protected $routesNumber;

    /** @var AbstractChampion */
    protected $nextAttack;

    /**
     * Game constructor.
     * @param array $config
     * @param AbstractChampion $knight
     * @param AbstractChampion $monster
     */
    public function __construct(array $config, AbstractChampion $knight, AbstractChampion $monster)
    {
        $this->routesNumber = $config['settings']['routesNumber'];
        $this->knight = $knight;
        $this->monster = $monster;
    }

    /**
     * @return $this
     */
    protected function nextRound(): Game
    {
        $this->round++;
        return $this;
    }

    /**
     * @return AbstractChampion
     * @throws Exception
     */
    protected function determineAttack(): AbstractChampion
    {
        if($this->knight->getSpeed() > $this->monster->getSpeed()) {
            $this->nextAttack = $this->knight;
        }

        if($this->knight->getSpeed() < $this->monster->getSpeed()) {
            $this->nextAttack = $this->monster;
        } elseif ($this->knight->getSpeed() == $this->monster->getSpeed()) {
            if($this->knight->getLuck() > $this->monster->getLuck()) {
                $this->nextAttack = $this->knight;
            }
            if($this->knight->getLuck() < $this->monster->getLuck()) {
                $this->nextAttack = $this->monster;
            }
            if($this->knight->getLuck() == $this->monster->getLuck()) {
                throw new Exception('Case not specified in the requirements.');
            }
        }

        return $this->nextAttack;
    }
}