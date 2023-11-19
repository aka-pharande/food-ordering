document.addEventListener('DOMContentLoaded', function () {
  const orderListElement = document.getElementById('orderList');
  const output = document.getElementById('output');
  const orderForm = document.getElementById('orderForm');

  // Fetch food orders from PHP backend on page load
  fetchOrderList();

  function fetchOrderList() {
    fetch('backend.php')
      .then(response => response.json())
      .then(data => {
        displayOrderList(data);
      })
      .catch(error => console.error('Error fetching order list:', error));
  }

  function displayOrderList(orderList) {
    orderListElement.innerHTML = '';

    orderList.forEach(order => {
      const listItem = document.createElement('li');
      listItem.className = 'order';
      listItem.textContent = `Item: ${order.foodItem}, Quantity: ${order.quantity}, Customer: ${order.customerName}`;
      orderListElement.appendChild(listItem);
    });
  }

  window.addOrder = function addOrder() {
    const foodItem = document.getElementById('foodItem').value;
    const quantity = document.getElementById('quantity').value;
    const customerName = document.getElementById('customerName').value;

    const newOrder = {
      foodItem: foodItem,
      quantity: parseInt(quantity),
      customerName: customerName,
    };

    sendToBackend(newOrder);

    resetForm();
  }

  function sendToBackend(order) {
    fetch('backend.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(order),
    })
      .then(response => response.json())
      .then(data => {
        output.textContent = data.message;
        fetchOrderList();
      })
      .catch(error => console.error('Error sending data to backend:', error));
  }

  function resetForm() {
    orderForm.reset();
  }
});
