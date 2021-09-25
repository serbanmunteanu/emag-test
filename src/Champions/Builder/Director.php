<?php

namespace App\Champions\Builder;

use App\Champions\Champion;
use Exception;

class Director {

    /**
     * @param ChampionBuilder $builder
     * @return Champion
     * @throws Exception
     */
    public function build(ChampionBuilder $builder): Champion
    {
        return $builder
            ->createModel()
            ->loadModelWithStats()
            ->setModelAbilities()
            ->getModel();
    }
}