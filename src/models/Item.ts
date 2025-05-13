export class Item {
  private rented: boolean = false;
  private rentalStartDate: string | null = null;
  private rentalEndDate: string | null = null;

  constructor(
    public readonly id: number,
    public readonly name: string
  ) {}

  public isAvailable(): boolean {
    return !this.rented;
  }

  public rent(startDate: string, endDate: string): boolean {
    if (!this.isAvailable()) {
      return false;
    }

    if (this.isValidRentalPeriod(startDate, endDate)) {
      this.rented = true;
      this.rentalStartDate = startDate;
      this.rentalEndDate = endDate;
      return true;
    }
    
    return false;
  }

  private isValidRentalPeriod(startDate: string, endDate: string): boolean {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const minRentalDuration = 24 * 60 * 60 * 1000;
    return (end.getTime() - start.getTime()) >= minRentalDuration;
  }

  public getRentalDetails(): string {
    if (this.rented) {
      return `Rented from ${this.rentalStartDate} to ${this.rentalEndDate}`;
    }
    return "Available";
  }
}
