<?php
// Step 1: Database connection
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "test1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Retrieve data from the database
$sql = "SELECT * FROM `plants`"; // Replace 'your_table_name' with the name of your table
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            "id" => $row["id"],
            "size" => $row["size"],
            "sizeDescription" => $row["sizeDescription"],
            "name" => $row["name"],
            "img" => $row["img"],
            "price" => $row["price"],
            "best" => (bool)$row["best"],
            "featured" => (bool)$row["featured"],
            "description" => $row["description"],
            "light" => $row["light"],
            "care" => $row["care"]
        );
    }
}

// Step 3: Output data as JSON
header('Content-Type: application/json');
echo json_encode(array("data" => $data));

$conn->close();
?>
