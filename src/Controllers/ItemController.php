<?php

namespace App\Controllers;

use App\Services\ItemService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ItemController {
    private ItemService $itemService;

    public function __construct() {
        $this->itemService = new ItemService();
    }

    public function getItems(Request $request, Response $response): Response {
        $items = $this->itemService->getAllItems();
        $data = array_map(fn($item) => [
            "id" => $item->getId(),
            "name" => $item->getName(),
            "status" => $item->getRentalDetails()
        ], $items);

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function rentItem(Request $request, Response $response): Response {
        $params = (array)$request->getParsedBody();
        try {
            $item = $this->itemService->rentItem($params['id'], $params['startDate'], $params['endDate']);
            $response->getBody()->write(json_encode(["message" => "Item rented successfully"]));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(["error" => $e->getMessage()]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    }

    public function getItemDetails(Request $request, Response $response, array $args): Response {
        try {
            $item = $this->itemService->getItemById((int)$args['id']);
            $data = [
                "id" => $item->getId(),
                "name" => $item->getName(),
                "status" => $item->getRentalDetails()
            ];
            $response->getBody()->write(json_encode($data));
            return $response->withHeader('Content-Type', 'application/json');
        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(["error" => $e->getMessage()]));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }
    }
}
