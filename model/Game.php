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
     * @var array the two-dimensional size of this Game
     */
    private $size;

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
     * @param array $size the two-dimensional size of the map of this Game
     */
    public function __construct($size)
    {
        $this->size = $size;
        $this->snake = new Snake(new Coord(mt_rand(1, $size[0] - 2), mt_rand(1, $size[1] - 2))); // randomly place Snake within the walls
        $this->map = new Map($size);

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
        // Move checks
        $this->snake->move($x, $y);
        if ($this->snake->hasEatenFood($this->map->getFoods())) {
            $this->map->removeFood($this->snake->getHead());
            $this->map->addRandomFood();
        } else {
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
        $hasEnded = count($this->snake->getBody()) !== count(array_unique($this->snake->getBody()));
        $hasEnded = $hasEnded || in_array($this->snake->getHead(), $this->map->getWalls());
        return $hasEnded;
    }

    /**
     * @return array the two-dimensional size of this Game
     */
    public function getSize(): array
    {
        return $this->size;
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
