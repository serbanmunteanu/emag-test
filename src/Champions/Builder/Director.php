<?php

namespace App\Champions\Builder;

use App\Champions\Champion;

class Director {

    public function build(ChampionBuilder $builder): Champion
    {
        return $builder
            ->makeEntity()
            ->setStats()
            ->getChampion();
    }
}