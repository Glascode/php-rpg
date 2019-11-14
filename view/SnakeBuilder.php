<?php

class SnakeBuilder extends CLI {

    public function update($game) {
        foreach ($game->getSnake()->getBody() as $coord) {
            $this->map[$coord->getX()][$coord->getY()] = 'S';
        }
    }

}