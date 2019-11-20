<?php

require_once './controller/Controller.php';

class CLIController extends Controller
{
    private $game;

    private const VALID_COMMANDS = ['z', 'q', 's', 'd', 'exit'];

    /**
     * Constructs a new CLIController.
     */
    public function __construct(Game &$game)
    {
        $this->game = $game;
    }

    private function isValid($command)
    {
        if ($command === 'exit') {
            echo 'Quitting game';
            exit(0);
        }
        return in_array($command, self::VALID_COMMANDS);
    }

    private function getInput()
    {
        $handle = fopen('php://stdin', 'r');
        echo "Go to > ";
        $input = trim(fgets($handle));
        return $input;
    }

    public function askMove()
    {
        $command = $this->getInput();

        while (!$this->isValid($command)) {
            $command = $this->getInput();
        }

        return $command;
    }
}