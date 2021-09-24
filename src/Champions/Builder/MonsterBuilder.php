<?php

namespace App\Champions\Builder;

use App\Champions\AbstractChampion;
use App\Champions\Monster;
use Exception;

class MonsterBuilder extends AbstractChampionBuilder
{
    /** @var Monster */
    protected $monster;

    /**
     * @return AbstractChampionBuilder
     */
    public function createModel(): AbstractChampionBuilder
    {
        $this->monster = new Monster();
        return $this;
    }

    /**
     * @return AbstractChampionBuilder
     * @throws Exception
     */
    public function loadModelWithStats(): AbstractChampionBuilder
    {
        $this->monster
            ->setName($this->championSettings['name'])
            ->setType(AbstractChampion::TYPE_MONSTER)
            ->setStrength($this->generateRandomValueFromConfig('strength'))
            ->setSpeed($this->generateRandomValueFromConfig('speed'))
            ->setDefence($this->generateRandomValueFromConfig('defence'))
            ->setHealth($this->generateRandomValueFromConfig('health'))
            ->setLuck($this->generateRandomValueFromConfig('luck'));

        return $this;
    }

    /**
     * @return AbstractChampionBuilder
     */
    public function setAbilities(): AbstractChampionBuilder
    {
        $this->monster->setAbilities($this->loadAbilities());
        return $this;
    }

    /**
     * @return AbstractChampion
     */
    public function getModel(): AbstractChampion
    {
        return $this->monster;
    }
}