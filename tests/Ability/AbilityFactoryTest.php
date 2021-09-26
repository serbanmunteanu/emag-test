<?php

use App\Abilities\Ability;
use App\Abilities\AbilityFactory;
use PHPUnit\Framework\TestCase;

final class AbilityFactoryTest extends TestCase
{
    /** @test */
    public function shouldCreate(): void
    {
        $ability = AbilityFactory::create('Test', 10, 2, 'defence');
        $this->assertInstanceOf(Ability::class, $ability);
        $this->assertEquals(10, $ability->getProbabilityToActivate());
        $this->assertSame('Test', $ability->getName());
        $this->assertEquals(2, $ability->getPower());
        $this->assertSame('defence', $ability->getType());
    }
}