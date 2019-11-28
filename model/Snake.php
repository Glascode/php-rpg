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
     * @param int $x the x move
     * @param int $y the y move
     */
    public function move($x, $y)
    {
        $this->lengthen($this->getHead()->getMove($x, $y));
    }

    /**
     * Returns true if this Snake's head is at the same position as another
     * located in an array.
     *
     * @param array $positions the array of positions to be tested
     * @return bool true if this Snake's head is at the same position of
     *     another in the positions array ; false otherwise
     */
    public function hasMovedTo(array $positions)
    {
        return in_array($this->getHead(), $positions);
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
     * Sets the head of this Snake.
     *
     * @param Coord $coord the new head of this Snake.
     */
    public function setHead(Coord $coord)
    {
        $this->body[count($this->body) - 1] = $coord;
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