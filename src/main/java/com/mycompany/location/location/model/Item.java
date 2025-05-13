package com.location.models;

import lombok.Getter;
import lombok.Setter;

import java.time.LocalDate;

@Getter
@Setter
public class Item {
    private final int id;
    private final String name;
    private boolean isRented = false;
    private LocalDate rentalStartDate;
    private LocalDate rentalEndDate;

    public Item(int id, String name) {
        this.id = id;
        this.name = name;
    }

    public boolean isAvailable() {
        return !isRented;
    }

    public boolean rent(LocalDate startDate, LocalDate endDate) {
        if (isAvailable() && !startDate.isAfter(endDate)) {
            this.isRented = true;
            this.rentalStartDate = startDate;
            this.rentalEndDate = endDate;
            return true;
        }
        return false;
    }

    public String getRentalDetails() {
        if (isRented) {
            return "Rented from " + rentalStartDate + " to " + rentalEndDate;
        }
        return "Available";
    }
}
