<?php

namespace App;

use App\Abilities\Ability;
use App\Abilities\AbilityFactory;
use App\Champions\Builder\ChampionBuilder;
use App\Champions\Builder\Director;
use App\Champions\Champion;
use App\Output\Adapters\CliOutput;
use App\Output\Adapters\LogOutput;
use App\Output\OutputService;
use Exception;

class Application
{
    /** @var mixed */
    protected $config;

    /** @var Game */
    protected $game;

    /** @var OutputService */
    protected $output;

    /** @var Champion[] */
    protected $knights = [];

    /** @var Champion[] */
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
        $this
            ->loadAbilities()
            ->loadChampions()
            ->loadOutput()
            ->loadGame();
    }

    /**
     * @param Champion $champion1
     * @param Champion $champion2
     * @throws Exception
     */
    public function startGame(Champion $champion1, Champion $champion2): void
    {
        $this->game->start($champion1, $champion2);
    }

    /**
     *
     */
    protected function loadAbilities(): Application
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

        return $this;
    }

    /**
     * @throws Exception
     */
    protected function loadChampions(): Application
    {
        $championsSetting = $this->config['champions'];
        $director = new Director();
        $championBuilder = new ChampionBuilder($this->abilities);

        foreach ($championsSetting as $championSettings) {
            $this->addChampion($championSettings, $director, $championBuilder);
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function loadGame(): Application
    {
        $this->game = new Game($this->config['game'], $this->getOutput());
        return $this;
    }

    /**
     * @return Application
     * @throws Exception
     */
    protected function loadOutput(): Application
    {
        $adapterSetting = $this->config['output'];
        switch ($adapterSetting) {
            case 'cli':
                $adapter = new CliOutput();
                break;
            case 'log':
                $adapter = new LogOutput();
                break;
            default:
                throw new Exception('Adapter not supported.');
        }
        $this->setOutput(new OutputService($adapter));
        return $this;
    }

    /**
     * @param array $championSettings
     * @param Director $director
     * @param ChampionBuilder $championBuilder
     * @throws Exception
     */
    protected function addChampion(array $championSettings, Director $director, ChampionBuilder $championBuilder): void
    {
        $championType = $championSettings['type'];
        $championBuilder->setChampionSettings($championSettings);
        $champion = $director->build($championBuilder);

        switch ($championType) {
            case Champion::TYPE_KNIGHT:
                $knights = $this->knights;
                $knights[$champion->getName()] = $champion;
                $this->knights = $knights;
                break;
            case Champion::TYPE_MONSTER:
                $monsters = $this->monsters;
                $monsters[$champion->getName()] = $champion;
                $this->monsters = $monsters;
                break;
            default:
                throw new Exception("Champion type ${championType} is not supported.");
        }
    }

    /**
     * @return Champion[]
     */
    public function getKnights(): array
    {
        return $this->knights;
    }

    /**
     * @return Champion[]
     */
    public function getMonsters(): array
    {
        return $this->monsters;
    }

    /**
     * @return OutputService
     */
    public function getOutput(): OutputService
    {
        return $this->output;
    }

    /**
     * @param OutputService $output
     * @return Application
     */
    public function setOutput(OutputService $output): Application
    {
        $this->output = $output;
        return $this;
    }
}