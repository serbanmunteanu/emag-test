<?php

namespace App\Gameplay;

use App\Champions\AbstractChampion;

class RoundFight
{
    /** @var AbstractChampion */
    protected $attacker;

    /** @var AbstractChampion */
    protected $defender;

    public function roundStart(Game $game)
    {
    }

    public function computeDamage(): int
    {
        return $this->attacker->getStrength() - $this->defender->getDefence();
    }
}