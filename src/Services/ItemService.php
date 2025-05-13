<?php

namespace App\Services;

use App\Models\Item;

class ItemService {
    private array $items;

    public function __construct() {
        $this->items = [
            new Item(1, "Car"),
            new Item(2, "Bike"),
            new Item(3, "House")
        ];
    }

    public function getAllItems(): array {
        return $this->items;
    }

    public function rentItem(int $id, string $startDate, string $endDate): ?Item {
        foreach ($this->items as $item) {
            if ($item->getId() === $id) {
                if ($item->rent($startDate, $endDate)) {
                    return $item;
                }
                throw new \Exception("Item is already rented or invalid rental period");
            }
        }
        throw new \Exception("Item not found");
    }

    public function getItemById(int $id): ?Item {
        foreach ($this->items as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }
        throw new \Exception("Item not found");
    }
}
