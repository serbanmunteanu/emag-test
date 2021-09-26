<?php

use App\Abilities\Ability;
use App\Champions\Builder\ChampionBuilder;
use App\Champions\Builder\Director;
use App\Champions\Champion;
use PHPUnit\Framework\TestCase;

class DirectorTest extends TestCase
{
    /** @var ChampionBuilder */
    protected $builder;

    /** @var Director */
    protected $director;

    /** @var Ability[] */
    protected $abilities = [];

    /**
     * Also a good idea to implement Mocks and tested
     * as methods on the builder were called
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->director = new Director();
        $this->builder = new ChampionBuilder($this->abilities);
        $this->builder->setChampionSettings([
            'name' => 'Orderus',
            'type' => 'knight',
            'health' => [
                'min' => 70,
                'max' => 100
            ],
            'strength' => [
                'min' => 70,
                'max' => 80
            ],
            'defence' => [
                'min' => 45,
                'max' => 55
            ],
            'speed' => [
                'min' => 40,
                'max' => 50
            ],
            'luck' => [
                'min' => 10,
                'max' => 30
            ],
            'abilities' => [
                'Rapid Strike',
                'Magic Shield'
            ]
        ]);
    }

    /** @test
     * @throws Exception
     */
    public function shouldBuild(): void
    {
        $model = $this->director->build($this->builder);
        $this->assertInstanceOf(Champion::class, $model);

        if (count($this->abilities) === 0) {
            $this->assertEquals(false, $model->hasDefenceAbilities());
            $this->assertEquals(false, $model->hasAttackAbilities());
        }

        $this->assertSame('Orderus', $model->getName());
    }
}