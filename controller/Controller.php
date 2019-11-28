<?php

abstract class Controller
{
    protected $game;

    /**
     * Constructs a new Controller.
     *
     * @param Game $game the Game
     */
    public function __construct(Game &$game)
    {
        $this->game = $game;
    }

    /**
     * Moves the Snake of the Game
     *
     * @param int $x the amount of x to move
     * @param int $y the amount of y to move
     */
    public function move($x, $y)
    {
        $this->game->moveSnake($x, $y);
    }

    /**
     * Runs the game.
     */
    public abstract function run();
}
