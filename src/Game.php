<?php

namespace App;

use App\Champions\Champion;
use Exception;

class Game
{
    /** @var Champion */
    protected $attacker;

    /** @var Champion */
    protected $defender;

    /** @var int  */
    protected $round = 1;

    /** @var int */
    protected $roundsNumber;

    /**
     * Game constructor.
     * @param int $roundsNumber
     */
    public function __construct(int $roundsNumber)
    {
        $this->roundsNumber = $roundsNumber;
    }

    /**
     * @param Champion $champion1
     * @param Champion $champion2
     * @throws Exception
     */
    public function start(Champion $champion1, Champion $champion2): void
    {
        $this->determineFirstAttack($champion1, $champion2);

        $round = new Round();
        while (!$this->isGameOver()) {
            $round->fight($this->getAttacker(), $this->getDefender());

            $this
                ->swap()
                ->nextRound();
        }
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
     * @param Champion $champion1
     * @param Champion $champion2
     * @return Game
     * @throws Exception
     */
    protected function determineFirstAttack(Champion $champion1, Champion $champion2): Game
    {
        if($champion1->getSpeed() > $champion2->getSpeed()) {
            $this->setAttacker($champion1);
            $this->setDefender($champion2);
        }

        if($champion1->getSpeed() < $champion2->getSpeed()) {
            $this->setAttacker($champion2);
            $this->setDefender($champion1);
        } elseif ($champion1->getSpeed() == $champion2->getSpeed()) {
            if($champion1->getLuck() > $champion2->getLuck()) {
                $this->setAttacker($champion1);
                $this->setDefender($champion2);
            }
            if($champion1->getLuck() < $champion2->getLuck()) {
                $this->setAttacker($champion2);
                $this->setDefender($champion1);
            }
            if($champion1->getLuck() == $champion2->getLuck()) {
                throw new Exception('Case not specified in the requirements.');
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function swap(): Game
    {
        $attacker = $this->getAttacker();
        $defender = $this->getDefender();
        $this->setDefender($attacker);
        $this->setAttacker($defender);
        return $this;
    }

    /**
     * @return bool
     */
    protected function isGameOver(): bool
    {
        if (!$this->attacker->isAlive()) {
            return true;
        }

        if (!$this->defender->isAlive()) {
            return true;
        }

        if ($this->round > $this->roundsNumber) {
            return true;
        }

        return false;
    }

    /**
     * @param Champion $attacker
     * @return Game
     */
    public function setAttacker(Champion $attacker): Game
    {
        $this->attacker = $attacker;
        return $this;
    }

    /**
     * @param Champion $defender
     * @return Game
     */
    public function setDefender(Champion $defender): Game
    {
        $this->defender = $defender;
        return $this;
    }

    /**
     * @return Champion
     */
    public function getAttacker(): Champion
    {
        return $this->attacker;
    }

    /**
     * @return Champion
     */
    public function getDefender(): Champion
    {
        return $this->defender;
    }
}