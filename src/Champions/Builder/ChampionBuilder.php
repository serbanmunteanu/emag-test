<?php

namespace App\Champions\Builder;

use App\Champions\Champion;

class ChampionBuilder
{
    /** @var Champion */
    protected $champion;

    /** @var array */
    protected $championSettings;

    public function __construct(array $championSetting)
    {
        $this->championSettings = $championSetting;
    }

    public function makeEntity(): ChampionBuilder
    {
        $this->champion = new Champion();
        return $this;
    }

    public function setStats(): ChampionBuilder
    {
        $this->champion
            ->setName($this->championSettings['name'])
            ->setHealth(0)
            ->setStrength(0)
            ->setDefence(0)
            ->setLuck(0);

//        foreach ($this->championSettings['abilities'] as $ability) {
//
//        }
        return $this;
    }

    public function getChampion(): Champion
    {
        return $this->champion;
    }
}