import express from "express";
import rentalRoutes from "./routes/rentalRoute";

const app = express();
const port = 3000;

app.use(express.json());
app.use("/api", rentalRoutes);

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
