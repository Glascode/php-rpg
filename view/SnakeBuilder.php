<?php

require_once './view/Observer.php';

class SnakeBuilder extends CLI implements Observer {

    public function update($game) {
        foreach ($game->getSnake()->getBody() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = '•';
        }

        $this->map[$game->getSnake()->getHead()->getY()][$game->getSnake()->getHead()->getX()] = 'O';
    }

}