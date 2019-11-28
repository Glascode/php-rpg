<?php

class CLIController extends Controller
{
    private const VALID_COMMANDS = ['z', 'q', 's', 'd', 'exit'];

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        echo $this->usage();
        echo "Legend:\n";
        echo "  O  Snake\n";
        echo "  *  Foods\n";
        echo "  X  Edges\n";

        $this->game->notifyObservers();

        while (!$this->game->hasEnded()) {
            $move = $this->askMove();
            $this->move($move[0], $move[1]);

            // Notify observers once actions were performed
            $this->game->notifyObservers();
        }

        echo "Game over! Your score: " . count($this->game->getSnake()->getBody()) . "\n";
    }

    /**
     * Returns the usage information string.
     *
     * @return string the usage information string
     */
    public function usage()
    {
        return "Play with Z, Q, S and D to move up, left, down and right respectively. Type 'exit' to quit the game.\n";
    }

    /**
     * Formats a move.
     *
     * @param string $move the move to be formatted
     * @return array the formatted move
     */
    private function formatMove(string $move)
    {
        $move = strtolower($move);
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
            echo "Bye!\n";
            exit(0);
        }

        if (!in_array($command, self::VALID_COMMANDS)) {
            echo "You typed a wrong command. ";
            echo $this->usage();
            return false;
        }

        return true;
    }

    private function getInput()
    {
        $handle = fopen('php://stdin', 'r');
        echo "Move > ";
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