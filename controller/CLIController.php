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

    /**
     * Formats a move.
     *
     * @param string $move the move to be formatted
     * @return array the formatted move
     */
    private function formatMove(string $move)
    {
        switch ($move) {
            case 'z':
                return [0, -1];
            case 'q':
                return [-1, 0];
            case 's':
                return [0, 1];
            case 'd':
                return [1, 0];
        }
        return [0, 0];
    }

    private function isValid($command)
    {
        if ($command === 'exit') {
            echo 'Quitting game';
            exit(0);
        }

        // TODO: print errors

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

        return $this->formatMove($command);
    }
}