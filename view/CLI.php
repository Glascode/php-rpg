<?php

class CLI extends Renderer {

    /**
     * Constructs a new CLI.
     *
     * @param array $size the two-dimensional size of the map
     */
    public function __construct(array $size) {
        $this->map = array_fill(0, $size->getY(), array_fill(0, $size->getX(), ''));
    }

    /**
     * Renders the map of this Renderer.
     */
    public function render() {
        foreach ($this->map as $y) {
            foreach ($y as $x) {
                echo $x;
            }
            echo "\n";
        }
    }
}
