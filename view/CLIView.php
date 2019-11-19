<?php

require_once './view/Observer.php';
require_once './view/Renderer.php';

class CLIView extends Renderer
{
    /**
     * Renders the map of this Renderer.
     */
    public function render($map)
    {
        foreach ($map as $row) {
            foreach ($row as $col) {
                echo "$col ";
            }
            echo "\n";
        }
    }
}
