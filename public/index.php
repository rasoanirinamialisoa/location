<?php

require __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Controllers\ItemController;

$app = AppFactory::create();

// Routes
$app->get('/api/items', [ItemController::class, 'getItems']);
$app->post('/api/items/rent', [ItemController::class, 'rentItem']);
$app->get('/api/items/{id}', [ItemController::class, 'getItemDetails']);

// Lancer l'application
$app->run();
