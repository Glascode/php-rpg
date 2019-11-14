<?php

class Map {

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
    public function __construct(array $size) {
        for ($y = 0; $y <= $size[1]; $y++) {
            for ($x = 0; $x <= $size[0]; $x++) {
                $this->walls[] = new Coord($x, $y);
            }
        }

        // Generate foods
        for ($_ = 0; $_ < mt_rand(0, $size / 3); $_++) {

        }
    }

    /**
     * Return the walls of this Map.
     *
     * @return array the walls of this Map
     */
    public function getWalls() {
        return $this->walls;
    }

    /**
     * Return the foods of this Map.
     *
     * @return array the foods of this Map
     */
    public function getFoods() {
        return $this->foods;
    }

}