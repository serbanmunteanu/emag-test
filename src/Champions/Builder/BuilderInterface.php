<?php

namespace App\Champions\Builder;

use App\Champions\Champion;

interface BuilderInterface
{
    public function createModel(): ChampionBuilder;

    public function loadModelWithStats(): ChampionBuilder;

    public function setModelAbilities(): ChampionBuilder;

    public function getModel(): Champion;
}