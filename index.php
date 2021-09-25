<?php

use App\Application;

require __DIR__ . "/vendor/autoload.php";

$app = new Application();
$app->bootstrap();

$knights = $app->getKnights();
$monsters = $app->getMonsters();

$app->startGame($knights['Orderus'], $monsters['Wild Monster']);
