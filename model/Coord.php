<?php

class Coord
{

    private $x;
    private $y;

    /**
     * Constructs a new Coord.
     *
     * @param int $x the x coordinate of this Coord
     * @param int $y the y coordinate of this Coord
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }


    /**
     * Updates this Coord's x and y values.
     *
     * @param int $x the x value to be added to this x
     * @param int $y the y value to be added to this y
     */
    public function move($x, $y)
    {
        $this->x += $x;
        $this->y += $y;
    }

    /**
     * Returns a new moved Coord.
     *
     * @param int $x the x value to be added to this x
     * @param int $y the y value to be added to this y
     * @return Coord the moved Coord
     */
    public function getMove($x, $y)
    {
        return new Coord($this->x += $x, $this->y += $y);
    }

    /**
     * Sets this x coordinate.
     *
     * @param int $x the new x coordinate
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * Returns this x coordinate.
     *
     * @return int $x this x coordinate.
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Sets this y coordinate.
     *
     * @param int $y the new y coordinate
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * Returns this y coordinate.
     *
     * @return int $y this y coordinate
     */
    public function getY()
    {
        return $this->y;
    }

    public function __toString()
    {
        return "$this->x, $this->y";
    }
}
