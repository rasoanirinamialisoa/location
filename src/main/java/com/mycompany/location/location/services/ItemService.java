package com.location.services;

import com.location.exceptions.ItemNotFoundException;
import com.location.models.Item;

import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;

public class ItemService {
    private final List<Item> items = new ArrayList<>();

    public ItemService() {
        items.add(new Item(1, "Car"));
        items.add(new Item(2, "Bike"));
        items.add(new Item(3, "House"));
    }

    public List<Item> getAllItems() {
        return items;
    }

    public Item rentItem(int id, LocalDate startDate, LocalDate endDate) {
        Item item = items.stream()
                .filter(i -> i.getId() == id)
                .findFirst()
                .orElseThrow(() -> new ItemNotFoundException("Item not found"));

        if (item.rent(startDate, endDate)) {
            return item;
        } else {
            throw new RuntimeException("Item is already rented or invalid rental period");
        }
    }

    public Item getItemById(int id) {
        return items.stream()
                .filter(i -> i.getId() == id)
                .findFirst()
                .orElseThrow(() -> new ItemNotFoundException("Item not found"));
    }
}
