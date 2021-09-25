<?php

namespace App\Abilities;

class AbilityFactory
{
    /**
     * @param string $name
     * @param int $probabilityToActivate
     * @param float $power
     * @param string $type
     * @return Ability
     */
    public static function create(string $name, int $probabilityToActivate, float $power, string $type): Ability
    {
        $ability = new Ability();
        $ability->setName($name)
            ->setType($type)
            ->setProbabilityToActivate($probabilityToActivate)
            ->setPower($power);
        return $ability;
    }
}