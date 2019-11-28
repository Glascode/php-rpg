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
        $this->snake = new Snake(new Coord(mt_rand(1, $size[0] - 2), mt_rand(1, $size[1] - 2))); // randomly place Snake within the edges
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
        $this->snake->move($x, $y);

        // Move checks
        if ($this->snake->hasMovedTo($this->map->getFoods())) {
            $this->map->removeFood($this->snake->getHead());
            $this->map->addRandomFood();
        } else {
            if ($this->snake->hasMovedTo($this->map->getEdges())) {
                $newX = gmp_intval(gmp_mod(strval($this->snake->getHead()->getX() + $x * 2), strval($this->size[0])));
                $newY = gmp_intval(gmp_mod(strval($this->snake->getHead()->getY() + $y * 2), strval($this->size[1])));
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
