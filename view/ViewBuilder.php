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
     * @param array $size the two-dimensional size of the map [cols, rows]
     */
    public function __construct(Game &$game)
    {
        $this->map = array_fill(0, $game->getSize()[1], array_fill(0, $game->getSize()[0], ' '));

        // Set walls
        foreach ($game->getMap()->getWalls() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = 'X';
        }

        $this->renderer = new CLIView();
    }

    /**
     * @return array the map of this ViewBuilder
     */
    public function getMap(): array
    {
        return $this->map;
    }

    /**
     * Performs specific updates for an Observer
     */
    public function update(Game $game)
    {
        foreach ($game->getSnake()->getBody() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = '•';
        }
        $this->map[$game->getSnake()->getHead()->getY()][$game->getSnake()->getHead()->getX()] = 'O';

        $this->renderer->render($this->map);
    }
}