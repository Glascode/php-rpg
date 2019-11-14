<?php


class MapBuilder extends CLI {

    public function update($game) {
        foreach ($game->getMap()->getWalls() as $wall) {
            $this->map[$wall->getX()][$wall->getY()] = '█';
        }
    }

}