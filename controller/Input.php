<?php

require_once './controller/Controller.php';

class Input extends Controller {

    public function isValid($move) {

    }

    private function getInput() {
        $handle = fopen('php://stdin', 'r');
        echo "Go to > ";
        $input = trim(fgets($handle));
        return $input;
    }

    public function askMove() {
        $move = $this->getInput();

        while (!$this->isValid($move)) {
            $move = $this->getInput();
        }

        return $move;
    }

}