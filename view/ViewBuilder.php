<?php

require_once './view/Observer.php';
require_once './view/CLIView.php';

class ViewBuilder implements Observer
{
    private $game;

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
    }

    /**
     * Performs specific updates for an Observer
     */
    public function update()
    {
        // Map initialisation
        $row = array_fill(0, $this->game->getSize()[0], ' ');
        $map = array_fill(0, $this->game->getSize()[1], $row);

        // Edges
        foreach ($this->game->getMap()->getEdges() as $coord) {
            $map[$coord->getY()][$coord->getX()] = 'X';
        }

        // Foods
        foreach ($this->game->getMap()->getFoods() as $food) {
            $map[$food->getY()][$food->getX()] = '*';
        }

        // Snake body
        foreach ($this->game->getSnake()->getBody() as $coord) {
            $map[$coord->getY()][$coord->getX()] = '•';
        }

        // Snake head
        $map[$this->game->getSnake()->getHead()->getY()][$this->game->getSnake()->getHead()->getX()] = 'O';

        $this->renderer->render($map);
    }
}