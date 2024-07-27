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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        // Signup action
        $store_name = $_POST['store_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("INSERT INTO suppliers (store_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $store_name, $email, $password);

        if ($stmt->execute() === TRUE) {
            // Redirect to supplier home page after successful signup
            $_SESSION["email"] = $email; // Start session
            $_SESSION["store_name"] = $store_name; // Store store_name in session
            // header("Location: http://localhost/project1/Plants-store-master/supplierHome.php");
            echo "registration successful, please login";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['login'])) {
        // Login action
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM suppliers WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            // Fetch the store name from the result set
            $row = $result->fetch_assoc();
            $store_name = $row['store_name'];

            // Authentication successful, start a session and store the email and store name
            $_SESSION["email"] = $email;
            $_SESSION["store_name"] = $store_name;
            $_SESSION["supplier_id"] = $row['id'];

            // Redirect to supplier home page after successful signin
            header("Location: http://localhost/project1/Plants-store-master/portal-theme-bs5-master/orders.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    }

}


$conn->close();
?>
