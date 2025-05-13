from datetime import datetime, timedelta

class Item:
    def __init__(self, item_id: int, name: str):
        self.id = item_id
        self.name = name
        self.is_rented = False
        self.rental_start_date = None
        self.rental_end_date = None

    def is_available(self) -> bool:
        return not self.is_rented

    def rent(self, start_date: str, end_date: str) -> bool:
        if not self.is_available():
            return False

        if self.is_valid_rental_period(start_date, end_date):
            self.is_rented = True
            self.rental_start_date = start_date
            self.rental_end_date = end_date
            return True
        return False

    def is_valid_rental_period(self, start_date: str, end_date: str) -> bool:
        start = datetime.strptime(start_date, '%Y-%m-%d')
        end = datetime.strptime(end_date, '%Y-%m-%d')
        return (end - start) >= timedelta(days=1)

    def get_rental_details(self) -> str:
        if self.is_rented:
            return f"Rented from {self.rental_start_date} to {self.rental_end_date}"
        return "Available"
