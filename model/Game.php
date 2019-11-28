<?php

require_once './model/Coord.php';
require_once './model/Map.php';
require_once './model/Model.php';
require_once './model/Snake.php';

require_once './controller/CLIController.php';

require_once './view/CLIView.php';
require_once './view/ViewBuilder.php';

class Game extends Model
{
    /**
     * @var Snake int the Snake of this Game
     */
    private $snake;

    /**
     * @var Map the Map of this Game
     */
    private $map;

    /**
     * Constructs a new Game.
     *
     * @param int $cols the number of columns of the map of this Game
     * @param int $rows the number of rows of the map of this Game
     */
    public function __construct($cols, $rows)
    {
        $this->cols = $cols;
        $this->rows = $rows;
        $this->snake = new Snake(new Coord(mt_rand(1, $cols - 2), mt_rand(1, $rows - 2))); // randomly place Snake within the edges
        $this->map = new Map($cols, $rows);

        $this->attachObserver(new ViewBuilder($this));
    }

    /**
     * Moves this Game's Snake and perform actions according to where it moves.
     *
     * @param int $x the x direction of the move
     * @param int $y the y direction of the move
     */
    public function moveSnake($x, $y)
    {
        $this->snake->move($x, $y);

        // Move checks
        if ($this->snake->hasMovedTo($this->map->getFoods())) {
            $this->map->removeFood($this->snake->getHead());
            $this->map->addRandomFood();
        } else {
            if ($this->snake->hasMovedTo($this->map->getEdges())) {
                $newX = gmp_intval(gmp_mod(strval($this->snake->getHead()->getX() + $x * 2), strval($this->map->getCols())));
                $newY = gmp_intval(gmp_mod(strval($this->snake->getHead()->getY() + $y * 2), strval($this->map->getRows())));
                $this->snake->setHead(new Coord($newX, $newY));
            }
            $this->snake->shift();
        }
    }

    /**
     * Returns true if this Game has ended.
     *
     * @return bool true if this Game has ended ; false otherwise
     */
    public function hasEnded()
    {
        return count($this->snake->getBody()) !== count(array_unique($this->snake->getBody()));
    }

    /**
     * Returns the Snake of this Game.
     *
     * @return Snake the Snake of this Game
     */
    public function getSnake()
    {
        return $this->snake;
    }

    /**
     * Return the Map of this Game.
     *
     * @return Map the Map of this Game
     */
    public function getMap()
    {
        return $this->map;
    }
}
