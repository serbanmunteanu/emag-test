<?php

namespace App\Output;

use App\Output\Adapters\OutputInterface;

class OutputService
{
    /** @var OutputInterface */
    protected $output;

    /**
     * OutputService constructor.
     * @param OutputInterface $adapter
     */
    public function __construct(OutputInterface $adapter)
    {
        $this->output = $adapter;
    }

    /**
     * @param string $message
     */
    public function write(string $message): void
    {
        $this->output->returnOutput($message);
    }
}