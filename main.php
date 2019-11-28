<?php

require_once './model/Game.php';
require_once './controller/CLIController.php';

$file_name = $argv[0]; // get the name used to run the script

function usage()
{
    global $file_name;
    return "usage: php $file_name [width height]\n";
}

// If there is only one argument (the name used to run the script)
if ($argc === 1) {
    // Set default values
    $cols = 20;
    $rows = 10;
} else {
    $pattern = "/^[1-9][0-9]{0,1}$/";
    array_shift($argv); // Remove the first element from $argv in order to access its elements easily
    if ($argc === 3 && preg_match($pattern, $argv[0]) && preg_match($pattern, $argv[1])) {
        $cols = $argv[0];
        $rows = $argv[1];
    } else {
        echo usage();
        echo "You may provide two separate integers (smaller than 100) for the game size.\n";
        exit(1);
    }
}

$game = new Game([$cols, $rows]);
$controller = new CLIController($game);
$controller->run();
