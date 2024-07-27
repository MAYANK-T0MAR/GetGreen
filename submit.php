<?php
session_start();

$dbhost = 'localhost:3306';
$dbuser = 'root';
$dbpass = ''; 
$dbname = 'test1';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO registration1 (firstName, lastName, email, password, number, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $number, $address);

    if ($stmt->execute() === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM registration1 WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        // Fetch the user's data
        $row = $result->fetch_assoc();
        
        // Set session variables
        $_SESSION['email'] = $email; // You can use any unique identifier here
        $_SESSION['firstName'] = $row['firstName']; // Retrieve the first name from the database
        $_SESSION['user_id'] = $row['id'];
        header("Location: http://localhost/project1/Plants-store-master/index.php");
    } else{
        echo "Invalid email or password.";
    }
}



$conn->close();
?>
