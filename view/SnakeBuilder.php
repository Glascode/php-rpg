<?php

require_once './view/ViewBuilder.php';

class SnakeBuilder extends ViewBuilder
{
    public function update($snake)
    {
        foreach ($snake->getBody() as $coord) {
            $this->map[$coord->getY()][$coord->getX()] = '•';
        }

        $this->map[$snake->getHead()->getY()][$snake->getHead()->getX()] = 'O';
    }
}