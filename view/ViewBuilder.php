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
        $this->map = $this->initMap();
        $this->renderer = new CLIView();
    }

    /**
     * Initialises the map.
     */
    private function initMap()
    {
        $map = array_fill(0, $this->game->getSize()[1], array_fill(0, $this->game->getSize()[0], ' '));
        foreach ($this->game->getMap()->getWalls() as $coord) {
            $map[$coord->getY()][$coord->getX()] = 'X';
        }
        return $map;
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
        $this->map = $this->initMap();

        foreach ($this->game->getSnake()->getBody() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = '•';
        }
        $this->map[$this->game->getSnake()->getHead()->getY()][$this->game->getSnake()->getHead()->getX()] = 'O';

        $this->renderer->render($this->map);
    }
}