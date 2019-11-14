<?php

class Coord {

    private $x;
    private $y;

    /**
     * Constructs a new Coord.
     *
     * @param int $x the x coordinate of this Coord
     * @param int $y the y coordinate of this Coord
     */
    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }


    /**
     * Updates this Coord's x and y values.
     *
     * @param $x int the x value to be added to this x
     * @param $y int the y value to be added to this y
     */
    public function move($x, $y) {
        $this->x += $x;
        $this->y += $y;
    }

    /**
     * Sets this x coordinate.
     *
     * @param mixed the new x coordinate
     */
    public function setX($x) {
        $this->x = $x;
    }

    /**
     * Returns this x coordinate.
     *
     * @return mixed this x coordinate.
     */
    public function getX() {
        return $this->x;
    }

    /**
     * Sets this y coordinate.
     *
     * @param mixed the new y coordinate
     */
    public function setY($y) {
        $this->y = $y;
    }

    /**
     * Returns this y coordinate.
     *
     * @return mixed this y coordinate
     */
    public function getY() {
        return $this->y;
    }

}
