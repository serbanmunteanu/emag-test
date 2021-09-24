<?php

namespace App\Champions\Builder;

use App\Abilities\Ability;
use Exception;

abstract class AbstractChampionBuilder implements BuilderInterface
{
    /** @var array */
    protected $championSettings;

    /** @var Ability[] */
    protected $availableAbilities;

    /**
     * ChampionBuilder constructor.
     * @param array $championSetting
     * @param array $abilities
     */
    public function __construct(array $championSetting, array $abilities)
    {
        $this->championSettings = $championSetting;
        $this->availableAbilities = $abilities;
    }

    /**
     * @param string $fieldName
     * @return int
     * @throws Exception
     */
    public function generateRandomValueFromConfig(string $fieldName): int
    {
        if (!$this->championSettings[$fieldName] ||
            !$this->championSettings[$fieldName]['min'] ||
            !$this->championSettings[$fieldName]['max'])
        {
            throw new Exception("Values not set for field ${fieldName}.");
        }

        return rand(
            $this->championSettings[$fieldName]['min'],
            $this->championSettings[$fieldName]['max']
        );
    }

    /**
     * @return Ability[]
     */
    public function loadAbilities(): array
    {
        $abilities = [];
        foreach ($this->availableAbilities as $availableAbility) {
            foreach ($this->championSettings['abilities'] as $ability) {
                if ($ability == $availableAbility->getName()) {
                    array_push($abilities, $availableAbility);
                }
            }
        }
        return $abilities;
    }
}