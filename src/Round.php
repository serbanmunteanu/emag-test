<?php

namespace App;

use App\Abilities\AbstractAbility;
use App\Champions\Champion;
use App\Output\OutputService;

class Round
{
    /** @var OutputService */
    protected $outputService;

    /**
     * Round constructor.
     * @param OutputService $outputService
     */
    public function __construct(OutputService $outputService)
    {
        $this->outputService = $outputService;
    }

    /**
     * @param Champion $attacker
     * @param Champion $defender
     * @return Round
     */
    public function fight(Champion $attacker, Champion $defender): Round
    {
        if ($this->isDefenderLuckyTurn($defender)) {
            $this->outputService->write("Lucky turn for " . $defender->getName() . ".Opponent missed their hit.");
            return $this;
        }

        $damage = $this->computeDamage($attacker, $defender);

        if ($attacker->hasAttackAbilities()) {
            foreach ($attacker->getAbilities()[AbstractAbility::TYPE_ATTACK] as $ability) {
                if ($ability->canBeUsed()) {
                    $this->outputService->write($attacker->getName() . ' use ability ' . $ability->getName());
                    $damage = $damage * $ability->getPower();
                }
            }
        }

        if ($defender->hasDefenceAbilities()) {
            foreach ($defender->getAbilities()[AbstractAbility::TYPE_DEFENCE] as $ability) {
                if ($ability->canBeUsed()) {
                    $this->outputService->write($defender->getName() . ' use ability ' . $ability->getName());
                    $damage = $damage / $ability->getPower();
                }
            }
        }

        $this->outputService->write($attacker->getName() . ' strike with ' . $damage . ' damage');
        $defender->setHealth($defender->getHealth() - $damage);
        $this->outputService->write($defender->getName() . ' has '. $defender->getHealth() . ' health left');

        return $this;
    }

    /**
     * @param Champion $attacker
     * @param Champion $defender
     * @return int
     */
    protected function computeDamage(Champion $attacker, Champion $defender): int
    {
        return $attacker->getStrength() - $defender->getDefence();
    }

    /**
     * @param Champion $defender
     * @return bool
     */
    protected function isDefenderLuckyTurn(Champion $defender): bool
    {
        return $defender->getLuck() >= rand(0, 100);
    }
}