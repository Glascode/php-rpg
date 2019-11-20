<?php

require_once './model/Model.php';

class Map extends Model
{
    const FOODS_RATE = 0.03;

    /**
     * @var array the array of walls of this Map
     */
    private $walls;

    /**
     * @var array the array of foods of this Map
     */
    private $foods;

    /**
     * Constructs a new Map.
     *
     * @param array $size the two-dimensional size of this Map
     */
    public function __construct(array $size)
    {
        $cols = $size[0];
        $rows = $size[1];

        // Init walls
        $this->walls = [];
        for ($col = 0; $col < $cols; $col++) {
            $this->walls[] = new Coord($col, 0);
            $this->walls[] = new Coord($col, $rows - 1);
        }
        for ($row = 0; $row < $rows; $row++) {
            $this->walls[] = new Coord(0, $row);
            $this->walls[] = new Coord($cols - 1, $row);
        }

        // Init foods
        $this->foods = [];
        foreach (range(0, floor(array_product($size) * self::FOODS_RATE)) as $_) {
            $this->foods[] = new Coord(mt_rand(1, $cols - 2), mt_rand(1, $rows - 2));
        }
    }

    /**
     * Return the walls of this Map.
     *
     * @return array the walls of this Map
     */
    public function getWalls()
    {
        return $this->walls;
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
}