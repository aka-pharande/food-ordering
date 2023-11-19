<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Food Ordering App</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Food Ordering App</h1>

  <div class="container">
    <div class="panel" id="leftPanel">
      <h2>Food Orders</h2>
      <ul id="orderList"></ul>
    </div>

    <div class="panel" id="rightPanel">
      <h2>Add New Order</h2>
      <form id="orderForm">
        <label for="foodItem">Food Item:</label>
        <input type="text" id="foodItem" name="foodItem" required>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>

        <label for="customerName">Customer Name:</label>
        <input type="text" id="customerName" name="customerName" required>

        <button type="button" onclick="addOrder()">Add Order</button>
      </form>

    <pre id="output"></pre>
  </div>

  <script src="script.js" defer></script>
</body>
</html>
