<?php

use App\Abilities\AbilityFactory;
use App\Champions\Builder\ChampionBuilder;
use App\Champions\Champion;
use PHPUnit\Framework\TestCase;

final class ChampionBuilderTest extends TestCase
{
    /** @var ChampionBuilder */
    protected $abstractBuilder;

    protected $championSetting = [
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
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $abilitiesSetting = [
            [
                'name' => 'Rapid Strike',
                'chance' => 10,
                'power' => 2,
                'type' => 'attack'
            ],
            [
                'name' => 'Magic Shield',
                'chance' => 20,
                'power' => 2,
                'type' => 'defence'
            ]
        ];
        $abilities = [];

        foreach ($abilitiesSetting as $abilitySettings) {
            $abilities[] = AbilityFactory::create(
                $abilitySettings['name'],
                $abilitySettings['chance'],
                $abilitySettings['power'],
                $abilitySettings['type']
            );
        }

        $this->abstractBuilder = new ChampionBuilder($abilities);
        $this->abstractBuilder
            ->createModel()
            ->setChampionSettings($this->championSetting);
    }

    /** @test */
    public function shouldCreateModel(): void
    {
        $this->assertInstanceOf(Champion::class, $this->abstractBuilder->getModel());
    }

    /** @test
     * @throws Exception
     */
    public function shouldLoadModelWithStats(): void
    {
        $model = $this->abstractBuilder->loadModelWithStats()->getModel();
        $this->assertSame($model->getName(), $this->championSetting['name']);
        $this->assertSame($model->getType(), $this->championSetting['type']);
        $this->assertThat(
            $model->getHealth(),
            $this->logicalAnd(
                $this->greaterThanOrEqual($this->championSetting['health']['min']),
                $this->lessThanOrEqual($this->championSetting['health']['max'])
            )
        );
        $this->assertThat(
            $model->getStrength(),
            $this->logicalAnd(
                $this->greaterThanOrEqual($this->championSetting['strength']['min']),
                $this->lessThanOrEqual($this->championSetting['strength']['max'])
            )
        );
        $this->assertThat(
            $model->getDefence(),
            $this->logicalAnd(
                $this->greaterThanOrEqual($this->championSetting['defence']['min']),
                $this->lessThanOrEqual($this->championSetting['defence']['max'])
            )
        );
        $this->assertThat(
            $model->getSpeed(),
            $this->logicalAnd(
                $this->greaterThanOrEqual($this->championSetting['speed']['min']),
                $this->lessThanOrEqual($this->championSetting['speed']['max'])
            )
        );
        $this->assertThat(
            $model->getLuck(),
            $this->logicalAnd(
                $this->greaterThanOrEqual($this->championSetting['luck']['min']),
                $this->lessThanOrEqual($this->championSetting['luck']['max'])
            )
        );
    }
}