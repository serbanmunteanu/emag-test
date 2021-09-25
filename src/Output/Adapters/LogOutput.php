<?php

namespace App\Output\Adapters;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LogOutput implements OutputInterface
{
    /** @var Logger  */
    protected $log;

    /**
     * LogOutput constructor.
     */
    public function __construct()
    {
        $this->log = new Logger('game');
        $this->log->pushHandler(new StreamHandler('./src/Output/Logs/game.log', Logger::DEBUG));
    }

    /**
     * @param string $message
     */
    public function returnOutput(string $message): void
    {
       $this->log->info($message);
    }
}