<?php

namespace App;

use App\Abilities\Ability;
use App\Abilities\AbilityFactory;
use App\Abilities\AbstractAbility;
use App\Champions\Builder\AbstractChampionBuilder;
use App\Champions\Builder\Director;
use App\Champions\AbstractChampion;
use App\Champions\Builder\KnightBuilder;
use App\Champions\Builder\MonsterBuilder;
use App\Champions\Knight;
use App\Champions\Monster;
use App\Gameplay\Game;
use Exception;

class Application {

    /** @var mixed */
    protected $config;

    /** @var Game */
    protected $game;

    /** @var Knight[] */
    protected $knights = [];

    /** @var Monster[] */
    protected $monsters = [];

    /** @var Ability[] */
    protected $abilities = [];

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->config = include('config.php');
    }

    /**
     * @throws Exception
     */
    public function bootstrap(): void
    {
        $this->loadAbilities();
        $this->loadChampions();
    }

    /**
     *
     */
    protected function loadAbilities(): void
    {
        $abilitiesSettings = $this->config['abilities'];

        foreach ($abilitiesSettings as $ability) {
            $this->abilities[] = AbilityFactory::create(
                $ability['name'],
                $ability['chance'],
                $ability['power'],
                $ability['type']
            );
        }
    }

    /**
     * @throws Exception
     */
    protected function loadChampions(): void
    {
        $championsSetting = $this->config['champions'];
        $director = new Director();

        foreach ($championsSetting as $championSettings) {
            $this->addChampion($championSettings, $director);
        }
    }

    /**
     * @param array $championSettings
     * @param Director $director
     * @throws Exception
     */
    protected function addChampion(array $championSettings, Director $director): void
    {
        $championType = $championSettings['type'];
        switch ($championType) {
            case AbstractChampion::TYPE_KNIGHT:
                $knights = $this->knights;
                $champion = $director->build(
                    new KnightBuilder($championSettings, $this->abilities)
                );
                $knights[$champion->getName()] = $champion;
                $this->knights = $knights;
                break;
            case AbstractChampion::TYPE_MONSTER:
                $monsters = $this->monsters;
                $champion = $director->build(
                    new MonsterBuilder($championSettings, $this->abilities)
                );
                $monsters[$champion->getName()] = $champion;
                $this->monsters = $monsters;
                break;
            default:
                throw new Exception("Champion type ${championType} is not supported.");
        }
    }
}