from models.item import Item

class ItemService:
    def __init__(self):
        self.items = [
            Item(1, "Car"),
            Item(2, "Bike"),
            Item(3, "House")
        ]

    def get_all_items(self) -> list:
        return self.items

    def rent_item(self, item_id: int, start_date: str, end_date: str) -> Item:
        item = next((i for i in self.items if i.id == item_id), None)
        if not item:
            raise Exception("Item not found")

        if not item.rent(start_date, end_date):
            raise Exception("Item is already rented or the period is invalid")
        
        return item

    def get_item_by_id(self, item_id: int) -> Item:
        item = next((i for i in self.items if i.id == item_id), None)
        if not item:
            raise Exception("Item not found")
        return item
