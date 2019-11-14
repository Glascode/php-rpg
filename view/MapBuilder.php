<?php

require_once './view/Observer.php';

class MapBuilder extends CLI implements Observer {

    public function update($game) {
        foreach ($game->getMap()->getFood() as $food) {
            $this->map[$food->getCoord()->getY()][$food->getCoord()->getX()] = '+';
        }
    }

}