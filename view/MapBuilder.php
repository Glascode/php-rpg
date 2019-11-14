<?php


class MapBuilder extends CLI implements Observer {

    public function update($game) {
        foreach ($game->getMap()->getWalls() as $wall) {
            $this->map[$wall->getX()][$wall->getY()] = '█';
        }
    }

}