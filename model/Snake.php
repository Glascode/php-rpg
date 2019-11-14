<?php

class Snake {

    /**
     * @var array the body of this Snake
     */
    private $body;

    /**
     * Constructs a new Snake.
     */
    public function __construct() {
    }


    /**
     * Returns the head of this Snake.
     *
     * @return Coord the head of this Snake.
     */
    public function getHead() {
        return $this->body[0];
    }

    /**
     * Returns the body of this Snake.
     *
     * @return array the body of this Snake
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Adds a Coord to the body of this Snake.
     *
     * @param Coord $coord the coord to be added to the body of this Snake
     */
    public function lengthen(Coord $coord) {
        $this->body[] = $coord;
    }

}