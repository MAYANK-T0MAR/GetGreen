<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: http://localhost/project1/supplier_login.html");
    exit();
}

$store_name = isset($_SESSION["store_name"]) ? $_SESSION["store_name"] : "";

// Logout functionality
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: http://localhost/project1/supplier_login.html");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GetGreen - Supplier panel</title>
  <link rel="stylesheet" href="css/supplierHome.css">


</head>
<body>

    <header>
        <div class="container">
          <h1>Welcome <?php echo $store_name; ?>!</h1>
        </div>
      </header>
    
      <nav>
        <div class="container">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Insert Product</a></li>
            <?php if (isset($_SESSION["email"])) { ?>
                <li><form method="post"><button type="submit" name="logout">Logout</button></form></li>
            <?php } ?>
          </ul>
        </div>
      </nav>
    
      <main>
        <div class="container">
            <h2>Insert New Product</h2>
            <form action="insertProduct.php" method="POST">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required>
        
              <label for="size">Size:</label>
              <input type="text" id="size" name="size" required>
        
              <label for="sizeDescription">Size Description:</label>
              <input type="text" id="sizeDescription" name="sizeDescription" required>
        
              <label for="img">Image URL:</label>
              <input type="text" id="img" name="img" required>
        
              <label for="price">Price:</label>
              <input type="number" id="price" name="price" min="0" step="0.01" required>
        
              <label for="best">Best:</label>
              <input type="checkbox" id="best" name="best">
        
              <label for="featured">Featured:</label>
              <input type="checkbox" id="featured" name="featured">
        
              <label for="description">Description:</label>
              <textarea id="description" name="description" required></textarea>
        
              <label for="light">Light:</label>
              <textarea id="light" name="light" required></textarea>
        
              <label for="care">Care:</label>
              <textarea id="care" name="care" required></textarea>
        
              <button type="submit" name="insert_Product">Insert Product</button>
            </form>
          </div>
      </main>
    
      
</body>
</html>
