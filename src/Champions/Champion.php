<?php

namespace App\Champions;

use App\Abilities\AbstractAbility;

class Champion
{
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
     * @return Champion
     */
    public function setName(string $name): Champion
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
     * @return Champion
     */
    public function setHealth(int $health): Champion
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
     * @return Champion
     */
    public function setStrength(int $strength): Champion
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
     * @return Champion
     */
    public function setDefence(int $defence): Champion
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
     * @return Champion
     */
    public function setSpeed(int $speed): Champion
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
     * @return Champion
     */
    public function setLuck(int $luck): Champion
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
     * @param AbstractAbility $ability
     * @return Champion
     */
    public function addAbility(AbstractAbility $ability): Champion
    {
        $this->abilities[$ability->getClassName()] = $ability;
        return $this;
    }

    /**
     * @param AbstractAbility[] $abilities
     * @return Champion
     */
    public function setAbilities(array $abilities): Champion
    {
        foreach ($abilities as $ability) {
            $this->addAbility($ability);
        }
        return $this;
    }

}