<?php

require_once './model/Model.php';

class Map extends Model
{
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
        for ($row = 0; $row <= $size[1]; $row++) {
            for ($col = 0; $col <= $size[0]; $col++) {
                $this->walls[] = new Coord($col, $row);
            }
        }

        // TODO: Generate foods

        $this->attachObserver(new MapBuilder($size));
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