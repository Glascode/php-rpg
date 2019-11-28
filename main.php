<?php

require_once './view/Observer.php';
require_once './view/Observable.php';
require_once './view/Renderer.php';
require_once './view/CLIView.php';
require_once './view/ViewBuilder.php';

require_once './model/Model.php';
require_once './model/Coord.php';
require_once './model/Snake.php';
require_once './model/Map.php';
require_once './model/Game.php';

require_once './controller/Controller.php';
require_once './controller/CLIController.php';


$file_name = $argv[0]; // get the name used to run the script

const DEFAULT_COLS = 20;
const DEFAULT_ROWS = 10;

function usage()
{
    global $file_name;
    return "usage: php $file_name [width height]\n";
}

// If we have an acceptable number of arguments
if ($argc === 3) {
    $pattern = "/^[1-9][0-9]{0,1}$/";
    array_shift($argv); // remove the first element from $argv since we don't need it anymore
    if (!preg_match($pattern, $argv[0]) || !preg_match($pattern, $argv[1])) {
        echo usage();
        echo "You may provide two separate integers (smaller than 100) for the game size.\n";
        exit(1);
    }
} else {
    $argv = [DEFAULT_COLS, DEFAULT_ROWS];
}

$game = new Game(...$argv);
$controller = new CLIController($game);
$controller->run();
