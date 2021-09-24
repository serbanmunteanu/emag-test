<?php

namespace App\Champions\Builder;

use App\Champions\AbstractChampion;
use App\Champions\Knight;
use Exception;

class KnightBuilder extends AbstractChampionBuilder
{
    /** @var Knight */
    protected $knight;

    /**
     * @return $this
     */
    public function createModel(): AbstractChampionBuilder
    {
        $this->knight = new Knight();
        return $this;
    }

    /**
     * @return KnightBuilder
     * @throws Exception
     */
    public function loadModelWithStats(): AbstractChampionBuilder
    {
        $this->knight
            ->setName($this->championSettings['name'])
            ->setType(AbstractChampion::TYPE_KNIGHT)
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
        $this->knight->setAbilities($this->loadAbilities());
        return $this;
    }

    /**
     * @return AbstractChampion
     */
    public function getModel(): AbstractChampion
    {
        return $this->knight;
    }
}