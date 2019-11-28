<?php

require_once './model/Model.php';

class Map extends Model
{
    const FOODS_RATE = 0.03;

    /**
     * @var int the number of columns of this Map
     */
    private $cols;

    /**
     * @var int the number of rows of this Map
     */
    private $rows;

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
     * @param int $cols the number of columns of this Map
     * @param int $rows the number of rows of this Map
     */
    public function __construct($cols, $rows)
    {
        $this->cols = $cols;
        $this->rows = $rows;

        // Init edges
        $this->edges = [];
        for ($col = 0; $col < $cols; $col++) {
            $this->edges[] = new Coord($col, 0);
            $this->edges[] = new Coord($col, $rows - 1);
        }
        for ($row = 0; $row < $rows; $row++) {
            $this->edges[] = new Coord(0, $row);
            $this->edges[] = new Coord($cols - 1, $row);
        }

        // Init foods
        $this->foods = [];
        foreach (range(0, floor($cols * $rows * self::FOODS_RATE)) as $_) {
            $this->addRandomFood();
        }
    }

    /**
     * Returns the number of columns of this Map.
     *
     * @return int the number of columns of this Map
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * Returns the number of rows of this Map.
     *
     * @return int the number of rows of this Map
     */
    public function getRows()
    {
        return $this->rows;
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
        $this->foods[] = new Coord(mt_rand(1, $this->cols - 2), mt_rand(1, $this->rows - 2));
    }
}