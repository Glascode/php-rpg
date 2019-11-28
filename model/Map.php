<?php

class Map extends Model
{
    const FOODS_RATE = 0.03;

    /**
     * @var int the width of this Map
     */
    private $width;

    /**
     * @var int the height of this Map
     */
    private $height;

    /**
     * @var array the array of edges of this Map
     */
    private $edges;

    /**
     * @var array the array of foods of this Map
     */
    private $foods;

    /**
     * Constructs a new Map.
     *
     * @param int $width the width (number of columns) of this Map
     * @param int $height the height (number of rows) of this Map
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        // Init edges
        $this->edges = [];
        for ($col = 0; $col < $width; $col++) {
            $this->edges[] = new Coord($col, 0);
            $this->edges[] = new Coord($col, $height - 1);
        }
        for ($row = 0; $row < $height; $row++) {
            $this->edges[] = new Coord(0, $row);
            $this->edges[] = new Coord($width - 1, $row);
        }

        // Init foods
        $this->foods = [];
        foreach (range(0, floor($width * $height * self::FOODS_RATE)) as $_) {
            $this->addRandomFood();
        }
    }

    /**
     * Returns the width of this Map.
     *
     * @return int the width of this Map
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Returns the height of this Map.
     *
     * @return int the height of this Map
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Return the edges of this Map.
     *
     * @return array the edges of this Map
     */
    public function getEdges()
    {
        return $this->edges;
    }

    /**
     * Return the foods of this Map.
     *
     * @return array the foods of this Map
     */
    public function getFoods()
    {
        return $this->foods;
    }

    /**
     * Removes a food from these foods.
     *
     * @param Coord $food the food to be removed
     */
    public function removeFood(Coord $food)
    {
        $this->foods = array_diff($this->foods, [$food]);
    }

    /**
     * Adds a random food to these foods.
     */
    public function addRandomFood()
    {
        $this->foods[] = new Coord(mt_rand(1, $this->width - 2), mt_rand(1, $this->height - 2));
    }
}