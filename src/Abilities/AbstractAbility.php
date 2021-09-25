<?php

namespace App\Abilities;

abstract class AbstractAbility implements AbilityInterface
{
    const TYPE_ATTACK = 'attack';
    const TYPE_DEFENCE = 'defence';

    /** @var int */
    protected $probabilityToActivate;

    /** @var float */
    protected $power;

    /** @var string */
    protected $name;

    /** @var string */
    protected $type;

    /**
     * @return int
     */
    public function getProbabilityToActivate(): int
    {
        return $this->probabilityToActivate;
    }

    /**
     * @param int $probabilityToActivate
     * @return AbstractAbility
     */
    public function setProbabilityToActivate(int $probabilityToActivate): AbstractAbility
    {
        $this->probabilityToActivate = $probabilityToActivate;
        return $this;
    }

    /**
     * @return bool
     */
    public function canBeUsed(): bool
    {
        return $this->getProbabilityToActivate() >= rand(0,100);
    }

    /**
     * @return string
     */
    public static function getClassName(): string
    {
        return static::class;
    }

    /**
     * @return float
     */
    public function getPower(): float
    {
        return $this->power;
    }

    /**
     * @param float $power
     * @return AbstractAbility
     */
    public function setPower(float $power): AbstractAbility
    {
        $this->power = $power;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return AbstractAbility
     */
    public function setName(string $name): AbstractAbility
    {
        $this->name = $name;
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
     * @return AbstractAbility
     */
    public function setType(string $type): AbstractAbility
    {
        $this->type = $type;
        return $this;
    }
}
