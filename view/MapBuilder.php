<?php

require_once './view/ViewBuilder.php';

class MapBuilder extends ViewBuilder
{
    public function update($map)
    {
        foreach ($map->getFood() as $food) {
            $this->map[$food->getCoord()->getY()][$food->getCoord()->getX()] = '+';
        }
    }
}