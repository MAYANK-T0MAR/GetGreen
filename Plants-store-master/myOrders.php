<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["email"])) {
  header("Location: http://localhost/project1/Plants-store-master/index.php");
  exit();
}

$loggedIn = isset($_SESSION['email']);
$show_login_message = !$loggedIn;

if (isset($_GET['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to login page or any other page after logout
    header("Location: http://localhost/project1/Plants-store-master/index.php");
    exit; // Exit to prevent further execution
}


// Database connection configuration
$servername = "localhost: 3306";
$username = "root";
$password = "";
$dbname = "test1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
// Fetch orders from the database with plant information
$sql = "SELECT o.*, p.name AS plant_name, p.img AS plant_img 
        FROM orders o 
        INNER JOIN plants p ON o.product_id = p.id
        WHERE o.user_id = $user_id";
        
$result = $conn->query($sql);



if(isset($_POST['cancel_order']) && isset($_POST['order_id'])) {
  $order_id = $_POST['order_id'];

  // Update the status in the orders table
  $sql = "UPDATE orders SET status = 'cancelled' WHERE id = $order_id";

  if ($conn->query($sql) === TRUE) {
      echo "Order status updated successfully";
  } else {
      echo "Error updating order status: " . $conn->error;
  }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- -- Bootstrap css cdn -- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- -- Font Awesom cdn --  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        /* -------- Basis ---------- */
:root {
  --white: #fff;
  --close: #fe0000;
  --dark-color: #23272b;
  --olive: #b2d3a6;
  --green: #00ba69;
  --darkGreen: #214f3d;
  --orange: #b55d47;
  --light-color: #ece7df;
}

        /* <!-- Navbar Section --> */
#navbar {
  background-color: var(--darkGreen);
}
.fa-bars {
  color: var(--white);
}
.nav-link {
  color: var(--white);
  font-size: 1.2rem;
  transition: all 0.3s ease;
}
.nav-link:hover {
  text-decoration: underline;
  color: var(--olive);
}
@media screen and (max-width: 768px) {
  .navbar-toggler:focus {
    border: none;
    outline: none;
  }
  .signin-nav {
    margin-left: 0.5rem;
    font-weight: bold;
  }
}

.nav-link .username {
  margin-right: 0.2rem; /* Adjust the margin as needed */
}

/* <!-- End of Navbar Section --> */


        .gallery {
  max-width: 1200px;
  margin: 0 auto;
  column-count: 4;
  font-family: arial;
}
.gallery-item {
  break-inside: avoid;
  margin-bottom: 16px;
  background-color: antiquewhite;
  padding: 15px;
  border-radius: 14px;
}
.gallery-item figure {
  margin: 0;
  position: relative;
}
.gallery-item figcaption {
  font-style: italic;
  padding: 8px;
  position: absolute;
  background: rgba(0, 0, 0, 0.5);
  width: 100%;
  box-sizing: border-box;
  bottom: 3px;
  color: #fff;
  height: 30px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  border-radius: 0 0 14px 14px;
}
.gallery-item img {
  width: 100%;
  border-radius: 14px;
}

.gallery-item .gallery-content{
  margin: 0;
  padding: 8px;
}

button {
    width: -webkit-fill-available;
    margin-top: 10px;
  padding: 1.3em 3em;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 500;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
}

button:hover {
  background-color: #c42323;
  box-shadow: 0px 15px 20px rgba(229, 46, 46, 0.4);
  color: #fff;
  transform: translateY(-7px);
}

button:active {
  transform: translateY(-1px);
}

@media screen and (max-width: 500px) {
  .gallery {
    column-count: 1;
  }
}
@media screen and (min-width: 501px) and (max-width: 700px) {
  .gallery {
    column-count: 2;
  }
}
@media screen and (min-width: 701px) and (max-width: 900px) {
  .gallery {
    column-count: 3;
  }
}




    </style>


</head>
<body style="background-color: #71C562 ;">

<!-- Navbar Section -->
<nav class="navbar navbar-expand-md py-0" id="navbar">
        <a href="./index.php" class="navbar-brand">
            <img src="./img/plantiful-logo.png" alt="logo" width="60px">
        </a>
        <!-- toggle btn -->
        <button class="navbar-toggler" data-toggle="collapse" data-target="#nav">
            <span class="navbar-icon">
                <i class="fas fa-bars"></i>
            </span>
        </button>
        <!-- nav -->
        <div class="collapse navbar-collapse mr-4" id="nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-2">
                <a href="index.php" class="nav-link">home</a>
                </li>
                <li class="nav-item mx-2">
                <a href="about.php" class="nav-link">about</a>
                </li>
                <li class="nav-item active mx-2">
                <a href="store.php" class="nav-link">store</a>
                </li>
                <li class="nav-item mx-2">
                <a href="contact.php" class="nav-link">contact</a>
                </li>
            </ul>
            <?php if($loggedIn): ?>
            <!-- If user is logged in -->
            <ul class="navbar-nav signin-nav">

            <li class="nav-item">
                    <a href="http://localhost/project1/Plants-store-master/myOrders.php" class="nav-link">
                        <span>My Orders</span>
                        <i class="bi bi-box-seam"></i> <!-- Adjust the icon class as needed -->
                    </a>
                </li>


                <li class="nav-item" id="last-nav">
                    <a href="cart.php" class="nav-link">
                        <span>Cart</span>
                        <i class="bi bi-cart3"></i>
                    </a>
                </li>
                
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <span class="username"><?php echo $_SESSION['firstName']; ?></span>
                        <i class="fas fa-user"></i> <!-- Adjust the icon class as needed -->
                    </a>
                </li>

                <li class="nav-item">
                    <a href="javascript:void(0);" onclick="logout()" class="nav-link">Logout</a>
                </li>
                

            </ul>

        <?php else: ?>
            <!-- If user is not logged in -->
            <ul class="navbar-nav signin-nav">
                <li class="nav-item">
                    <a href="http://localhost/project1/RBredirection.html" class="nav-link">Sign In</a>
                </li>
                <li class="nav-item" id="last-nav">
                    <a href="#" id="cart-link" class="nav-link">Cart(<span class="cart-item-number">0</span>)</a>
                </li>
            </ul>
        <?php endif; ?>
        </div>
    </nav>

<section>
<div class="container py-5">
<div class="row d-flex justify-content-center my-4">
<div class="gallery">
        <!-- <div class="gallery-item">
          <figure>
            <img src="https://images.dog.ceo/breeds/hound-english/n02089973_3147.jpg" alt="dog" />
          </figure>
          <div class="gallery-content">
            <h1>name</h1>
            <p>Price : <span>100</span></p>
            <p>Quantity : <span>3</span></p>
            <p>Total Amount : <span>300</span></p>
            <p>Status : <span>shipped</span></p>
            <a href="#"><button>click me</button></a>
          </div>
        </div>
        <div class="gallery-item">
          <figure>
            <img src="https://images.dog.ceo/breeds/hound-english/n02089973_3147.jpg" alt="dog" />
          </figure>
          <div class="gallery-content">
            <h1>name</h1>
            <p>Price : <span>100</span></p>
            <p>Quantity : <span>3</span></p>
            <p>Total Amount : <span>300</span></p>
            <p>Status : <span>shipped</span></p>
            <a href="#"><button>click me</button></a>
          </div>
        </div> -->

        <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="gallery-item">';
                        echo '<figure>';
                        // echo '<img src="' . $row['plant_img'] . '" alt="' . $row['plant_name'] . '" />';
                        echo '<a href="http://localhost/project1/Plants-store-master/product.php?id=' . $row["product_id"] . '">';
                        echo '<img src="' . $row['plant_img'] . '" alt="' . $row['plant_name'] . '" />';
                        echo '</a>';

                        echo '</figure>';
                        echo '<div class="gallery-content">';
                        echo '<h4>' . $row['plant_name'] . '</h1>';
                        echo '<p>Price : <span>' . $row['price'] . '</span></p>';
                        echo '<p>Quantity : <span>' . $row['quantity'] . '</span></p>';
                        echo '<p>Total Amount : <span>' . $row['total_price'] . '</span></p>';
                        echo '<p>Status : <span>' . $row['status'] . '</span></p>';
                        // echo '<a href="#"><button>Cancel Order</button></a>';
                        // echo '<form method="post" action="">
                        //         <input type="hidden" name="order_id" value="' . $row['id'] . '">
                        //         <button type="submit" name="cancel_order">Cancelled</button>
                        //       </form>';

                        // Check if the order status is not "cancelled"
        if($row['status'] != 'cancelled') {
          echo '<form method="post" action="">
                  <input type="hidden" name="order_id" value="' . $row['id'] . '">
                  <button type="submit" name="cancel_order" id="cancelOrderBtn">Cancel Order</button>
                </form>';
      }
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>




      </div>
</div>
</div>
</section>

<script>

  // Function to handle logout
        function logout() {
            // Send a GET request to the same page with a logout parameter
            window.location.href = "myOrders.php?logout=true";
        }
    
    document.addEventListener('DOMContentLoaded', function() {
        var cancelOrderBtn = document.getElementById('cancelOrderBtn');
        if (cancelOrderBtn) {
            cancelOrderBtn.addEventListener('click', function(event) {
                setTimeout(function() {
                    location.reload();
                }, 2000); // Delay of 2 seconds (2000 milliseconds)
            });
        }
    });

</script>
  </body>
  </html>