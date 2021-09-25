<?php

namespace App\Output\Adapters;

interface OutputInterface
{
    public function returnOutput(string $message): void;
}