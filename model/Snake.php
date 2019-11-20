<?php

class Snake extends Model
{
    /**
     * @var array the body of this Snake
     */
    private $body;

    /**
     * Constructs a new Snake.
     */
    public function __construct(Coord $head)
    {
        $this->body = [$head];
    }

    /**
     * Moves this Snake.
     *
     * @param $x
     * @param $y
     */
    public function move($x, $y)
    {
        $this->lengthen(end($this->body)->getMove($x, $y));
    }

    /**
     * Returns true if this Snake's head is at the same position of a food.
     *
     * @param array $foods the array of foods
     * @return bool true if this Snake's head is at the same position of a food ; false otherwise
     */
    public function hasEatenFood(array $foods)
    {
        return in_array($this->getHead(), $foods);
    }

    /**
     * Returns the head of this Snake.
     *
     * @return Coord the head of this Snake.
     */
    public function getHead()
    {
        return end($this->body);
    }

    /**
     * Returns the body of this Snake.
     *
     * @return array the body of this Snake
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Adds a Coord to the body of this Snake.
     *
     * @param Coord $coord the coord to be added to the body of this Snake
     */
    public function lengthen(Coord $coord)
    {
        $this->body[] = $coord;
    }

    /**
     * Shifts this Snake's body
     */
    public function shift()
    {
        array_shift($this->body);
    }
}