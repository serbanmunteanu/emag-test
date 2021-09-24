<?php

namespace App\Champions\Builder;

use App\Abilities\Ability;
use App\Champions\AbstractChampion;

interface BuilderInterface
{
    public function createModel(): AbstractChampionBuilder;

    public function loadModelWithStats(): AbstractChampionBuilder;

    public function setAbilities(): AbstractChampionBuilder;

    public function getModel(): AbstractChampion;
}