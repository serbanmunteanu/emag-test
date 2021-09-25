<?php

namespace App;

use App\Champions\Champion;
use App\Output\OutputService;
use Exception;

class Game
{
    /** @var Champion */
    protected $attacker;

    /** @var Champion */
    protected $defender;

    /** @var Champion */
    protected $winner;

    /** @var int */
    protected $round = 1;

    /** @var int */
    protected $roundsNumber;

    /** @var OutputService */
    protected $outputService;

    /**
     * Game constructor.
     * @param array $gameConfig
     * @param OutputService $outputService
     */
    public function __construct(array $gameConfig, OutputService $outputService)
    {
        $this->roundsNumber = $gameConfig['roundsNumber'];
        $this->outputService = $outputService;
    }

    /**
     * @param Champion $champion1
     * @param Champion $champion2
     * @throws Exception
     */
    public function start(Champion $champion1, Champion $champion2): void
    {
        $this->outputService->write('Game started');

        $this->determineFirstAttack($champion1, $champion2);
        $this->outputService->write("First attacker is " . $this->getAttacker()->getName());

        $round = new Round($this->outputService);
        while (!$this->isGameOver()) {
            $this->outputService->write("Round " . $this->getRound() . " started");

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
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    /**
     * @param Champion $champion1
     * @param Champion $champion2
     * @return Game
     * @throws Exception
     */
    protected function determineFirstAttack(Champion $champion1, Champion $champion2): Game
    {
        if ($champion1->getSpeed() > $champion2->getSpeed()) {
            $this->setAttacker($champion1);
            $this->setDefender($champion2);
        }

        if ($champion1->getSpeed() < $champion2->getSpeed()) {
            $this->setAttacker($champion2);
            $this->setDefender($champion1);
        } elseif ($champion1->getSpeed() == $champion2->getSpeed()) {
            if ($champion1->getLuck() > $champion2->getLuck()) {
                $this->setAttacker($champion1);
                $this->setDefender($champion2);
            }
            if ($champion1->getLuck() < $champion2->getLuck()) {
                $this->setAttacker($champion2);
                $this->setDefender($champion1);
            }
            if ($champion1->getLuck() == $champion2->getLuck()) {
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
        if (!$this->getAttacker()->isAlive()) {
            $this->outputService->write('The winner is ' . $this->getDefender()->getName());
            return true;
        }

        if (!$this->getDefender()->isAlive()) {
            $this->outputService->write('The winner is ' . $this->getAttacker()->getName());
            return true;
        }

        if ($this->round > $this->roundsNumber) {
            $this->determineWinner();
            if ($this->winner) {
                $this->outputService->write('The winner is ' . $this->getWinner()->getName());
            } else {
                $this->outputService->write('Tie game');
            }
            return true;
        }

        return false;
    }

    /**
     *
     */
    protected function determineWinner(): void
    {
        if ($this->getAttacker()->getHealth() > $this->getDefender()->getHealth()) {
            $this->setWinner($this->getAttacker());
        }
        if ($this->getAttacker()->getHealth() < $this->getDefender()->getHealth()) {
            $this->setWinner($this->getDefender());
        }
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

    /**
     * @return Champion
     */
    public function getWinner(): Champion
    {
        return $this->winner;
    }

    /**
     * @param Champion $winner
     * @return Game
     */
    public function setWinner(Champion $winner): Game
    {
        $this->winner = $winner;
        return $this;
    }
}