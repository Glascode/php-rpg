<?php

require_once './model/Game.php';
require_once './controller/CLIController.php';

$game = new Game([20, 10]);

$controller = new CLIController($game);
$controller->run();
