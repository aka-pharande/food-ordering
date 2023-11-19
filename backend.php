<?php
header('Content-Type: application/json');

// Read existing food orders from XML file
$xml = simplexml_load_file('orders.xml');
$orderList = [];

foreach ($xml->order as $order) {
  $orderList[] = [
    'foodItem' => (string)$order->foodItem,
    'quantity' => (int)$order->quantity,
    'customerName' => (string)$order->customerName,
  ];
}

// If POST data is received, add a new order to the XML file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $postData = json_decode(file_get_contents('php://input'), true);

  if ($postData) {
    // Append the new order to the existing XML file
    $newOrder = $xml->addChild('order');
    $newOrder->addChild('foodItem', $postData['foodItem']);
    $newOrder->addChild('quantity', $postData['quantity']);
    $newOrder->addChild('customerName', $postData['customerName']);
    $xml->asXML('orders.xml');

    echo json_encode(['success' => true, 'message' => 'Order added successfully!']);
  } else {
    echo json_encode(['success' => false, 'message' => 'Invalid data!']);
  }
} else {
  // If it's a GET request, send the order list to JavaScript
  echo json_encode($orderList);
}
?>
