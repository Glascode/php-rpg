<?php

class Map {

    /**
     * @var array the array of walls of this Map
     */
    private $walls;

    /**
     * Constructs a new Map.
     *
     * @param array $size the two-dimensional size of this Map
     */
    public function __construct(array $size) {
        for ($y = 0; $y < $size[1]; $y++) {
            for ($x = 0; $x < $size[0]; $x++) {
                $this->walls[] = new Coord($x, $y);
            }
        }
    }


}