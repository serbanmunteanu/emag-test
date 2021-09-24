<?php

namespace App\Champions\Builder;

use App\Champions\AbstractChampion;
use Exception;

class Director {

    /**
     * @param AbstractChampionBuilder $builder
     * @return AbstractChampion
     * @throws Exception
     */
    public function build(AbstractChampionBuilder $builder): AbstractChampion
    {
        return $builder
            ->createModel()
            ->loadModelWithStats()
            ->setAbilities()
            ->getModel();
    }
}