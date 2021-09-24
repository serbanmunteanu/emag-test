<?php

namespace App\Abilities;

abstract class AbstractAbility
{
    public $Type;

    public static function getClassName(): string
    {
        return static::class;
    }
}