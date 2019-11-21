<?php

require_once './model/Game.php';
require_once './controller/CLIController.php';

$file_name = $argv[0]; //$argv — Array of arguments passed to script //The first argument $argv[0] is always the name that was used to run the script.

function usage()
{
    global $file_name;
    return "usage: php $file_name [width height]\n";
}

if ($argc === 1) { // $argc — The number of arguments passed to script
    // Set default values
    $cols = 20;
    $rows = 10;
} else {
    $pattern = "/^[1-9][0-9]{0,1}$/";
    array_shift($argv); //The array_shift() function is used to remove the first element from an array, and returns the value of the removed element.
    if ($argc === 3 && preg_match($pattern, $argv[0]) && preg_match($pattern, $argv[1])) { //preg_match — Perform a regular expression match
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
