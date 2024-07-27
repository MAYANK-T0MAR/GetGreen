<?php
session_start();
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = ''; // assuming no password is set for the database
    $dbname = 'test1';

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $size = $_POST['size'];
    $sizeDescription = $_POST['sizeDescription'];
    $img = $_POST['img'];
    $price = $_POST['price'];
    $best = isset($_POST['best']) ? 1 : 0; // Convert checkbox value to 1 or 0
    $featured = isset($_POST['featured']) ? 1 : 0; // Convert checkbox value to 1 or 0
    $description = $_POST['description'];
    $light = $_POST['light'];
    $care = $_POST['care'];
    $supplier_id = $_SESSION['supplier_id'];

    // Step 3: Prepare and bind parameters for insertion
    $stmt = $conn->prepare("INSERT INTO plants (name, size, sizeDescription, img, price, best, featured, description, light, care, supplier_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssssiiisssi", $name, $size, $sizeDescription, $img, $price, $best, $featured, $description, $light, $care, $supplier_id);

    // Step 4: Execute the prepared statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Step 5: Close statement and connection
    $stmt->close();
    $conn->close();
?>


