// src/routes/rentalRoutes.ts
import { Router } from "express";
import { getItems, rentItem, getItemRentals } from "../controllers/rentalController";

const router: Router = Router();

router.get("/items", getItems);
router.post("/rent", rentItem);
router.get("/rentals/:itemId", getItemRentals);

export default router;
