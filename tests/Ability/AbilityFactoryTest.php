<?php

use App\Abilities\Ability;
use App\Abilities\AbilityFactory;
use PHPUnit\Framework\TestCase;

final class AbilityFactoryTest extends TestCase
{
    /** @var Ability  */
    protected $ability;

    /**  */
    public function setUp(): void
    {
        parent::setUp();
        $this->ability = AbilityFactory::create('Test', 10, 2, 'defence');
    }

    /** @test */
    public function shouldCreate(): void
    {
        $this->assertInstanceOf(Ability::class, $this->ability);
        $this->assertEquals(10, $this->ability->getProbabilityToActivate());
        $this->assertSame('Test', $this->ability->getName());
        $this->assertEquals(2, $this->ability->getPower());
        $this->assertSame('defence', $this->ability->getType());
    }
}