<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Handle case when user is not logged in
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = ''; 
$dbname = 'test1';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product id from the request
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$userId = $_SESSION['user_id']; // Get user id from session

// Check if the product is already in the cart
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
$stmt->bind_param("ii", $userId, $productId);
$stmt->execute();
$result = $stmt->get_result();
$existingCartItem = $result->fetch_assoc();
$stmt->close();

if ($existingCartItem) {
    // If the product is already in the cart, update the quantity
    $quantity = $existingCartItem['quantity'] + 1;
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("iii", $quantity, $userId, $productId);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true, 'message' => 'Quantity updated successfully']);
} else {
    // If the product is not in the cart, insert a new row
    $quantity = 1;
    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $userId, $productId, $quantity);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true, 'message' => 'Product added to cart successfully']);
}

$conn->close();
?>
