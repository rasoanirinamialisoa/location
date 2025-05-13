package com.mycompany.location.location.controllers;

import com.location.models.Item;
import com.location.services.ItemService;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDate;
import java.util.List;

@RestController
@RequestMapping("/api/items")
public class ItemController {
    private final ItemService itemService = new ItemService();

    @GetMapping
    public ResponseEntity<List<Item>> getItems() {
        return ResponseEntity.ok(itemService.getAllItems());
    }

    @PostMapping("/rent")
    public ResponseEntity<String> rentItem(@RequestParam int id,
                                           @RequestParam String startDate,
                                           @RequestParam String endDate) {
        try {
            LocalDate start = LocalDate.parse(startDate);
            LocalDate end = LocalDate.parse(endDate);
            Item item = itemService.rentItem(id, start, end);
            return ResponseEntity.ok("Item rented successfully from " + start + " to " + end);
        } catch (Exception e) {
            return ResponseEntity.badRequest().body(e.getMessage());
        }
    }

    @GetMapping("/{id}")
    public ResponseEntity<Item> getItemDetails(@PathVariable int id) {
        try {
            return ResponseEntity.ok(itemService.getItemById(id));
        } catch (Exception e) {
            return ResponseEntity.notFound().build();
        }
    }
}
