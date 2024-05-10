<?php
$foodItems = array(
  "Pizza" => 300,
  "Burger" => 100,
  "Fries" => 50,
  "Salad" => 75
);
if (isset($_POST['submit'])) {

  $selectedItem = $_POST['food_item'];
  $quantity = (int)$_POST['quantity']; 
  $cashPaid = (float)$_POST['cash_paid']; 

  if (!empty($selectedItem) && $quantity > 0 && $cashPaid >= 0) {

    $totalCost = $foodItems[$selectedItem] * $quantity;

    if ($cashPaid >= $totalCost) {

      $change = $cashPaid - $totalCost;
      $message = "Your order for " . $quantity . " " . $selectedItem . " has been placed!  Change due: PHP" . number_format($change, 2);
    } else {
      $message = "Insufficient cash. Total cost is PHP" . number_format($totalCost, 2) . ". Please enter a higher amount.";
    }
  } else {
    $message = "Please select a food item, enter a valid quantity, and cash amount.";
  }
} else {
  $message = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Management System</title>
</head>
<body>
  <h1>Austin Eats</h1>
  <p>Hello welcome, here is the menu :)</p>
    <p>Pizza - 300 PHP</p>
    <p>Burger - 100 PHP</p>
    <p>Fries - 50 PHP</p>
    <p>Salad - 75 PHP</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="food_item">Food Item:</label>
    <select name="food_item" id="food_item">
      <?php foreach ($foodItems as $item => $price) : ?>
        <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
      <?php endforeach; ?>
    </select><br>
    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" min="1" required><br>
    <label for="cash_paid">Cash Paid:</label>
    <input type="number" name="cash_paid" id="cash_paid" min="0" step="0.01" required><br><br>
    <input type="submit" name="submit" value="Order Food">
  </form>

  <?php if (!empty($message)) : ?>
    <p><?php echo $message; ?></p>
  <?php endif; ?>

</body>
</html>
