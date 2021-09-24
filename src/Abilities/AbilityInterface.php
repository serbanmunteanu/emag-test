<?php

namespace App\Abilities;

interface AbilityInterface
{
    public function canBeUsed(): bool;
}