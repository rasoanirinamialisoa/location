import { Request, Response } from "express";
import { Item } from "../models/Item";

let items: Item[] = [
  new Item(1, "Car"),
  new Item(2, "Bike"),
  new Item(3, "House")
];

export const getItems = (req: Request, res: Response): void => {
  res.json(items.map(item => ({
    id: item.id,
    name: item.name,
    status: item.getRentalDetails()
  })));
};

export const rentItem = (req: Request, res: Response): void => {
  const { itemId, startDate, endDate } = req.body;
  const item = items.find(i => i.id === itemId);

  if (!item) {
    res.status(404).json({ error: "Item not found" });
    return;
  }

  const success = item.rent(startDate, endDate);

  if (!success) {
    res.status(400).json({ error: "Item is already rented or invalid rental period" });
    return;
  }

  res.status(200).json({ message: `Item rented from ${startDate} to ${endDate}` });
};

export const getItemRentals = (req: Request, res: Response): void => {
  const { itemId } = req.params;
  const item = items.find(i => i.id === parseInt(itemId));

  if (!item) {
    res.status(404).json({ error: "Item not found" });
    return;
  }

  res.json({
    itemId: item.id,
    name: item.name,
    rentalDetails: item.getRentalDetails()
  });
};
