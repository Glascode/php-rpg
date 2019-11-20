<?php

require_once './view/Observer.php';
require_once './view/CLIView.php';

class ViewBuilder implements Observer
{
    private $game;

    private $map;

    private $renderer;

    /**
     * Constructs a new ViewBuilder.
     *
     * @param Game $game the game
     */
    public function __construct(Game &$game)
    {
        $this->game = $game;
        $this->renderer = new CLIView();
        $this->update();
    }

    /**
     * @return array the map of this ViewBuilder
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Performs specific updates for an Observer
     */
    public function update()
    {
        // Map initialisation
        $this->map = array_fill(0, $this->game->getSize()[1], array_fill(0, $this->game->getSize()[0], ' '));

        // Walls
        foreach ($this->game->getMap()->getWalls() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = 'X';
        }

        // Foods
        foreach ($this->game->getMap()->getFoods() as $food) {
            $this->map[$food->getY()][$food->getX()] = '*';
        }

        // Snake body
        foreach ($this->game->getSnake()->getBody() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = '•';
        }

        // Snake head
        $this->map[$this->game->getSnake()->getHead()->getY()][$this->game->getSnake()->getHead()->getX()] = 'O';

        $this->renderer->render($this->map);
    }
}