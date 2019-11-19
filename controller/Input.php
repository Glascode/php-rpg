<?php

require_once './controller/Controller.php';

class Input extends Controller
{
    private $game;

    private const VALID_COMMANDS = ['z', 'q', 's', 'd'];

    /**
     * Constructs a new Input.
     */
    public function __construct(Game &$game)
    {
        $this->game = $game;
    }

    private function isValid($move)
    {
        return in_array($move, self::VALID_COMMANDS);
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
        $move = $this->getInput();

        while (!$this->isValid($move)) {
            $move = $this->getInput();
        }

        return $move;
    }
}