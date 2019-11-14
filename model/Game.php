<?php

require_once './model/Coord.php';
require_once './model/Map.php';
require_once './model/Snake.php';

require_once './view/CLI.php';
require_once './view/MapBuilder.php';
require_once './view/SnakeBuilder.php';

class Game {

    /**
     * @var array the array of observers of this Game
     */
    private $observers;

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
     * @var Renderer the view renderer for this Game
     */
    private $renderer;

    /**
     * @var array the array of view builders for this Game
     */
    private $builders;

    /**
     * Constructs a new Game.
     *
     * @param array $size the two-dimensional size of the map of this Game
     */
    public function __construct($size) {
        $this->size = $size;
        $this->snake = new Snake(new Coord(mt_rand(0, $size[0] - 1), mt_rand(0, $size[1] - 1)));
        $this->map = new Map($size);

        $this->observers = [];
        $this->observers[] = new MapBuilder($this->size);
        $this->observers[] = new SnakeBuilder($this->size);

        $this->renderer = new CLI($this->size);
    }

    /**
     * Returns the Snake of this Game.
     *
     * @return Snake the Snake of this Game
     */
    public function getSnake() {
        return $this->snake;
    }

    /**
     * Return the Map of this Game.
     *
     * @return Map the Map of this Game
     */
    public function getMap() {
        return $this->map;
    }

    /**
     * Returns true if this Game has ended.
     *
     * @return bool true if this Game has ended ; false otherwise
     */
    private function hasEnded() {
        return count($this->snake->getBody()) !== count(array_unique($this->snake->getBody()));
    }

    /**
     * Runs this Game.
     */
    public function run() {
        while (!$this->hasEnded()) {
            echo 'input';
            // TODO: Ask user input

            // Actions
            // ...

            foreach ($this->observers as $observer) {
                $observer->update($this);
            }

            // Render once all actions were performed
            $this->renderer->render();
        }
    }
}
