<?php

namespace App;

use App\Abilities\AbstractAbility;
use App\Champions\Champion;

class Round
{
    /**
     * @param Champion $attacker
     * @param Champion $defender
     * @return Round
     */
    public function fight(Champion $attacker, Champion $defender): Round
    {
        if ($this->isDefenderLuckyTurn($defender)) {
            return $this;
        }

        $damage = $this->computeDamage($attacker, $defender);

        if ($attacker->hasAttackAbilities()) {
            foreach ($attacker->getAbilities()[AbstractAbility::TYPE_ATTACK] as $ability) {
                if ($ability->canBeUsed()) {
                    $damage = $damage * $ability->getPower();
                }
            }
        }

        if ($defender->hasDefenceAbilities()) {
            foreach ($defender->getAbilities()[AbstractAbility::TYPE_DEFENCE] as $ability) {
                if ($ability->canBeUsed()) {
                    $damage = $damage / $ability->getPower();
                }
            }
        }

        $defender->setHealth($defender->getHealth() - $damage);

        var_dump($defender->getName(), $defender->getHealth());

        return $this;
    }

    /**
     * @param Champion $attacker
     * @param Champion $defender
     * @return int
     */
    public function computeDamage(Champion $attacker, Champion $defender): int
    {
        return $attacker->getStrength() - $defender->getDefence();
    }

    /**
     * @param Champion $defender
     * @return bool
     */
    public function isDefenderLuckyTurn(Champion $defender): bool
    {
        return $defender->getLuck() >= rand(0, 100);
    }
}