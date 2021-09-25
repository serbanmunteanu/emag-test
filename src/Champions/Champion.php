<?php

namespace App\Champions;

use App\Abilities\AbstractAbility;

class Champion
{
    const TYPE_KNIGHT = 'knight';
    const TYPE_MONSTER = 'monster';

    /** @var string */
    protected $name;

    /** @var float */
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

    /** @var array */
    protected $abilities = [];

    /** @var bool */
    protected $hasAttackAbilities = false;

    /** @var bool */
    protected $hasDefenceAbilities = false;

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
     * @return float
     */
    public function getHealth(): float
    {
        return $this->health;
    }

    /**
     * @param float $health
     * @return Champion
     */
    public function setHealth(float $health): Champion
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
     * @param AbstractAbility[] $abilities
     * @return Champion
     */
    public function setAbilities(array $abilities): Champion
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
     * @return Champion
     */
    public function setType(string $type): Champion
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAlive(): bool
    {
        return $this->health > 0;
    }

    /**
     * @return bool
     */
    public function hasAttackAbilities(): bool
    {
        return $this->hasAttackAbilities;
    }

    /**
     * @param bool $hasAttackAbilities
     * @return Champion
     */
    public function setHasAttackAbilities(bool $hasAttackAbilities): Champion
    {
        $this->hasAttackAbilities = $hasAttackAbilities;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDefenceAbilities(): bool
    {
        return $this->hasDefenceAbilities;
    }

    /**
     * @param bool $hasDefenceAbilities
     * @return Champion
     */
    public function setHasDefenceAbilities(bool $hasDefenceAbilities): Champion
    {
        $this->hasDefenceAbilities = $hasDefenceAbilities;
        return $this;
    }
}