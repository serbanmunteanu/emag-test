<?php

namespace App\Output\Adapters;

class CliOutput implements OutputInterface
{
    /**
     * @param string $message
     */
    public function returnOutput(string $message): void
    {
        print_r($message . PHP_EOL);
    }
}