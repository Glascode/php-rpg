<?php

require_once './view/Renderer.php';

class CLI extends Renderer
{
    /**
     * Constructs a new CLI.
     *
     * @param array $size the two-dimensional size of the map
     */
    public function __construct(array $size)
    {
        $this->map = array_fill(0, $size[1], array_fill(0, $size[0], ' '));

        // Update walls
        for ($row = 0; $row < $size[1]; $row++) {
            for ($col = 0; $col < $size[0]; $col++) {
                $this->map[$row][$col] = 'X';
            }
        }
    }

    /**
     * Renders the map of this Renderer.
     */
    public function render()
    {
        foreach ($this->map as $y) {
            foreach ($y as $x) {
                echo $x;
            }
            echo "\n";
        }
    }
}
