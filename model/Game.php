<?php

require_once 'Snake.php';
require_once 'Map.php';

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

    // TODO: $foods, either put it here or in Map

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
     * @param $size array the two-dimensional size of the map of this Game
     */
    public function __construct($size) {
        $this->size = $size;
        $this->snake = new Snake();
        $this->map = new Map($size);

        $this->renderer = new CLI($this->size);

        $this->builders = [];
        $this->builders[] =  new MapBuilder($this->size);
        $this->builders[] =  new SnakeBuilder($this->size);
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
        return count($this->snake->getBody()) === count(array_flip($this->snake->getBody()));
    }

    /**
     * Runs this Game.
     */
    public function run() {
        while (!$this->hasEnded()) {
            // Actions
            // ...

            foreach ($this->observers as $observer) {
                $observer->update($this);
            }

            // Render
            $this->renderer->render();
        }
    }
}
