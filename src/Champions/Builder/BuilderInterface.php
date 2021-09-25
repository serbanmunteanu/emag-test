<?php

namespace App\Champions\Builder;

use App\Champions\Champion;

interface BuilderInterface
{
    public function createModel(): ChampionBuilder;

    public function loadModelWithStats(): ChampionBuilder;

    public function setAbilities(): ChampionBuilder;

    public function getModel(): Champion;
}