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
     * @var array the array of observers of this Game
     */
    protected $observers;

    /**
     * @var Controller the controller for this Game
     */
    private $controller;

    /**
     * @var Renderer the view renderer for this Game
     */
    private $renderer;

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

        $this->controller = new CLIController($this);
        $this->renderer = new CLIView();
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
        if (in_array(new Coord($x, $y), $this->map->getWalls())) {

        }

        // Move this Snake
        $this->snake->move($x, $y);
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

    /**
     * Runs this Game.
     */
    public function run()
    {
        while (!$this->hasEnded()) {
            $move = $this->controller->askMove();

            $this->snake->move($move[0], $move[1]);

            // Perform actions
            // ...

            // Notify observers once all actions were performed
            $this->notifyObservers();
        }
    }
}
