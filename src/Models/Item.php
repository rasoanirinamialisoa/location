<?php

namespace App\Models;

class Item {
    private int $id;
    private string $name;
    private bool $isRented = false;
    private ?string $rentalStartDate = null;
    private ?string $rentalEndDate = null;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function isAvailable(): bool {
        return !$this->isRented;
    }

    public function rent(string $startDate, string $endDate): bool {
        if ($this->isAvailable() && $this->isValidRentalPeriod($startDate, $endDate)) {
            $this->isRented = true;
            $this->rentalStartDate = $startDate;
            $this->rentalEndDate = $endDate;
            return true;
        }
        return false;
    }

    public function getRentalDetails(): string {
        if ($this->isRented) {
            return "Rented from $this->rentalStartDate to $this->rentalEndDate";
        }
        return "Available";
    }

    private function isValidRentalPeriod(string $startDate, string $endDate): bool {
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $oneDay = 24 * 60 * 60;
        return ($end - $start) >= $oneDay;
    }
}
