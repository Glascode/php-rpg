<?php

require_once './model/Coord.php';
require_once './model/Map.php';
require_once './model/Model.php';
require_once './model/Snake.php';

require_once './view/CLI.php';
require_once './view/MapBuilder.php';
require_once './view/SnakeBuilder.php';

class Game extends Model
{
    /**
     * @var array the two-dimensional size of the map of this Game
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
        $this->snake = new Snake(new Coord(mt_rand(1, $size[0] - 2), mt_rand(1, $size[1] - 2))); // randomly place Snake
        $this->map = new Map($size);

        $this->renderer = new CLI($this->size);
    }

    /**
     * Returns true if this Game has ended.
     *
     * @return bool true if this Game has ended ; false otherwise
     */
    private function hasEnded()
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

    /**
     * Runs this Game.
     */
    public function run()
    {
        while (!$this->hasEnded()) {
            echo 'input';
            // TODO: Ask user input

            // Actions
            // ...

            $this->notifyObservers();
            $this->map->notifyObservers();

            // Render once all actions were performed
            $this->renderer->render();
        }
    }
}
