<?php

namespace App\Champions\Builder;

use App\Abilities\Ability;
use App\Abilities\AbstractAbility;
use App\Champions\Champion;
use Exception;

class ChampionBuilder implements BuilderInterface
{
    /** @var array */
    protected $championSettings;

    /** @var Ability[] */
    protected $availableAbilities;

    /** @var Champion */
    protected $champion;

    /**
     * ChampionBuilder constructor.
     * @param array $abilities
     */
    public function __construct(array $abilities)
    {
        $this->availableAbilities = $abilities;
    }

    /**
     * @param string $fieldName
     * @return int
     * @throws Exception
     */
    public function generateRandomValue(string $fieldName): int
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
     * @return array
     */
    public function loadAbilities(): array
    {
        $abilities = [];
        foreach ($this->availableAbilities as $availableAbility) {
            foreach ($this->championSettings['abilities'] as $ability) {
                if ($ability == $availableAbility->getName()) {
                    $abilities[$availableAbility->getType()][] = $availableAbility;
                }
            }
        }
        return $abilities;
    }

    /**
     * @param array $championSettings
     * @return ChampionBuilder
     */
    public function setChampionSettings(array $championSettings): ChampionBuilder
    {
        $this->championSettings = $championSettings;
        return $this;
    }

    /**
     * @return ChampionBuilder
     */
    public function createModel(): ChampionBuilder
    {
        $this->champion = new Champion();
        return $this;
    }

    /**
     * @return ChampionBuilder
     * @throws Exception
     */
    public function loadModelWithStats(): ChampionBuilder
    {
        $this->champion
            ->setName($this->championSettings['name'])
            ->setType($this->championSettings['type'])
            ->setStrength($this->generateRandomValue('strength'))
            ->setSpeed($this->generateRandomValue('speed'))
            ->setDefence($this->generateRandomValue('defence'))
            ->setHealth($this->generateRandomValue('health'))
            ->setLuck($this->generateRandomValue('luck'));

        return $this;
    }

    /**
     * @return ChampionBuilder
     */
    public function setModelAbilities(): ChampionBuilder
    {
        $abilities = $this->loadAbilities();
        if (!empty($abilities)) {
            if (!empty($abilities[AbstractAbility::TYPE_ATTACK])) {
                $this->champion->setHasAttackAbilities(true);
            }
            if (!empty($abilities[AbstractAbility::TYPE_DEFENCE])) {
                $this->champion->setHasDefenceAbilities(true);
            }
        }
        $this->champion->setAbilities($this->loadAbilities());
        return $this;
    }

    /**
     * @return Champion
     */
    public function getModel(): Champion
    {
        return $this->champion;
    }
}
