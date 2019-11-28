<?php

namespace Snake;

class CLIView implements Renderer
{
    /**
     * Renders the map of this Renderer.
     */
    public function render($map)
    {
        echo "\e[H\e[2J"; // clear console

        foreach ($map as $row) {
            foreach ($row as $col) {
                echo "$col ";
            }
            echo "\n";
        }
    }
}
