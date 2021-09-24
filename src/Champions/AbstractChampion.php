<?php

namespace App\Champions;

use App\Abilities\AbstractAbility;

abstract class AbstractChampion
{
    const TYPE_KNIGHT = 'knight';
    const TYPE_MONSTER = 'monster';

    /** @var string */
    protected $name;

    /** @var int */
    protected $health;

    /** @var int */
    protected $strength;

    /** @var int */
    protected $defence;

    /** @var int */
    protected $speed;

    /** @var int */
    protected $luck;

    /** @var string */
    protected $type;

    /** @var AbstractAbility[] */
    protected $abilities = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AbstractChampion
     */
    public function setName(string $name): AbstractChampion
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getHealth(): int
    {
        return $this->health;
    }

    /**
     * @param int $health
     * @return AbstractChampion
     */
    public function setHealth(int $health): AbstractChampion
    {
        $this->health = $health;
        return $this;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return $this->strength;
    }

    /**
     * @param int $strength
     * @return AbstractChampion
     */
    public function setStrength(int $strength): AbstractChampion
    {
        $this->strength = $strength;
        return $this;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @param int $defence
     * @return AbstractChampion
     */
    public function setDefence(int $defence): AbstractChampion
    {
        $this->defence = $defence;
        return $this;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @param int $speed
     * @return AbstractChampion
     */
    public function setSpeed(int $speed): AbstractChampion
    {
        $this->speed = $speed;
        return $this;
    }

    /**
     * @return int
     */
    public function getLuck(): int
    {
        return $this->luck;
    }

    /**
     * @param int $luck
     * @return AbstractChampion
     */
    public function setLuck(int $luck): AbstractChampion
    {
        $this->luck = $luck;
        return $this;
    }

    /**
     * @return AbstractAbility[]
     */
    public function getAbilities(): array
    {
        return $this->abilities;
    }

    /**
     * @param AbstractAbility[] $abilities
     * @return AbstractChampion
     */
    public function setAbilities(array $abilities): AbstractChampion
    {
        $this->abilities = $abilities;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return AbstractChampion
     */
    public function setType(string $type): AbstractChampion
    {
        $this->type = $type;
        return $this;
    }
}