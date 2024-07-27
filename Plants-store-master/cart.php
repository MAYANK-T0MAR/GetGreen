<?php
session_start();

// Check if user is logged in
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


// Check if user ID is stored in the session
if(isset($_SESSION['user_id'])) {
    // User is logged in, fetch cart items associated with the user
    $user_id = $_SESSION['user_id'];
    
    // Replace with your database connection details
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
    
    // Check if the checkout button is clicked
if(isset($_POST['checkout'])) {
    // Fetch cart data
    $fetch_cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
    $cart_result = $conn->query($fetch_cart_query);
    
    if($cart_result->num_rows > 0) {
        // Prepare the INSERT query for orders
        $insert_order_query = "INSERT INTO orders (user_id, product_id, supplier_id, price, quantity, total_price, order_date, status) VALUES ";
        
        // Get the current date and time
        $current_date = date('Y-m-d H:i:s');
        
        // Initialize total order price
        $total_order_price = 0;
        
        while ($row = $cart_result->fetch_assoc()) {
            // Get cart item details
            $cart_id = $row['id'];
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            
            // Fetch product details
            $fetch_product_query = "SELECT * FROM plants WHERE id = $product_id";
            $product_result = $conn->query($fetch_product_query);
            
            if($product_result->num_rows > 0) {
                $product_row = $product_result->fetch_assoc();
                
                // Calculate total price for the current item
                $price = $product_row['price'];
                $total_price = $price * $quantity;
                
                // Add the current item's details to the INSERT query
                $insert_order_query .= "($user_id, $product_id, {$product_row['supplier_id']}, $price, $quantity, $total_price, '$current_date', 'received'),";
                
                // Update total order price
                $total_order_price += $total_price;
            }
        }
        
        // Remove the trailing comma from the query
        $insert_order_query = rtrim($insert_order_query, ',');
        
        // Execute the INSERT query
        if ($conn->query($insert_order_query)) {
            // Clear the cart after successful checkout
            $clear_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
            if ($conn->query($clear_cart_query)) {
                echo "Orders placed successfully.";
            } else {
                echo "Error clearing cart: " . $conn->error;
            }
        } else {
            echo "Error inserting orders: " . $conn->error;
        }
    } else {
        echo "No items in the cart.";
    }
}







    // Check if a product ID and action (increase or decrease) are provided for updating quantity
    if(isset($_POST['update_product_id']) && isset($_POST['action'])) {
        // Sanitize the input
        $product_id = intval($_POST['update_product_id']);
        $action = $_POST['action'];
        
        // Get the current quantity of the item
        $get_quantity_query = "SELECT quantity FROM cart WHERE product_id = $product_id AND user_id = $user_id";
        $quantity_result = $conn->query($get_quantity_query);
        $row = $quantity_result->fetch_assoc();
        $current_quantity = $row['quantity'];
        
        if($action === 'increase') {
            // Increase the quantity by 1
            $new_quantity = $current_quantity + 1;
        } elseif($action === 'decrease') {
            // Decrease the quantity by 1
            $new_quantity = max(0, $current_quantity - 1); // Ensure quantity doesn't go negative
        }
        
        if($new_quantity === 0) {
            // If quantity becomes zero, remove the item from the cart
            $remove_query = "DELETE FROM cart WHERE product_id = $product_id AND user_id = $user_id";
            $remove_result = $conn->query($remove_query);
        } else {
            // Update the quantity of the item in the cart
            $update_query = "UPDATE cart SET quantity = $new_quantity WHERE product_id = $product_id AND user_id = $user_id";
            $update_result = $conn->query($update_query);
        }
    }

    // Query to fetch cart items with related product details
    $sql = "SELECT cart.user_id, cart.quantity, plants.id as product_id, plants.name, plants.size, plants.price, plants.img FROM cart INNER JOIN plants ON cart.product_id = plants.id WHERE cart.user_id = $user_id";
    $result = $conn->query($sql);

    // Check for errors in the query
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Subtotal calculation
    $subTotal = 0;
    $numRows = 0;
} else {
    // User is not logged in, display alert message
    header("Location: http://localhost/project1/Plants-store-master/index.php");
    exit; 
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content here -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CART</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- -- Bootstrap css cdn -- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- -- Font Awesom cdn --  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <link rel="stylesheet" href="css/cart.css">
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
                    <a href="#" id="cart-link" class="nav-link">Cart</a>
                </li>
            </ul>
        <?php endif; ?>
        </div>
    </nav>

<section>
    <div class="container py-5">
        <!-- Success Alert -->
        <div id="successAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
        <strong>Order placed!</strong> Thank you for your purchase. Your package will be delivered within 7 days of your purchase.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <div class="row d-flex justify-content-center my-4">
            <!-- Your row content here -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Cart - <?php echo $result->num_rows; ?> items</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $numRows++;
                                $subTotal += $row['price'] * $row['quantity'];
                                ?>
                                <!-- Single item -->
                                <div class="row">
                                    <!-- Your row content here -->
                                    <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                        <!-- Your column content here -->
                                        <!-- Image -->
                                        <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                             data-mdb-ripple-color="light">
                                            <img src="<?php echo $row['img']; ?>" class="w-100"
                                                 alt="<?php echo $row['name']; ?>"/>
                                            <a href="http://localhost/project1/Plants-store-master/product.php?id=<?php echo $row['product_id']; ?>">
                                                <div class="mask"
                                                     style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                            </a>
                                        </div>
                                        <!-- Image -->
                                    </div>
                                    <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                        <!-- Your column content here -->
                                        <!-- Data -->
                                        <p><strong><?php echo $row['name']; ?></strong></p>
                                        <p>Size: <?php echo $row['size']; ?></p>
                                        <!-- Update quantity buttons -->
                                        <div class="quantity-update">
                                            <button class="btn btn-primary btn-sm me-1 mb-2 update-quantity"
                                                data-product-id="<?php echo $row['product_id']; ?>" data-action="decrease">-</button>
                                            <span><?php echo $row['quantity']; ?></span>
                                            <button class="btn btn-primary btn-sm me-1 mb-2 update-quantity"
                                                data-product-id="<?php echo $row['product_id']; ?>" data-action="increase">+</button>
                                        </div>
                                        <!-- Data -->
                                    </div>
                                    <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                        <!-- Your column content here -->
                                        <!-- Quantity -->
                                        <p class="text-start text-md-center">
                                            <strong>Quantity: <?php echo $row['quantity']; ?></strong>
                                        </p>
                                        <!-- Quantity -->

                                        <!-- Price -->
                                        <p class="text-start text-md-center">
                                            <strong>₹<?php echo $row['price']; ?></strong>
                                        </p>
                                        <!-- Price -->
                                    </div>
                                </div>
                                <!-- Single item -->
                            <?php }
                            $result->data_seek(0); // Reset the result set pointer
                        } else {
                            echo "<p>No items in the cart.</p>";
                        }
                        ?>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body">
                        <p><strong>Expected shipping delivery</strong></p>
                        <p class="mb-0">7 Days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Products
                                <span>₹<?php echo number_format($subTotal, 2); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Payment Method
                                <span>Cash On Delivery</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                    <strong>
                                        <p class="mb-0">(including all charges)</p>
                                    </strong>
                                </div>
                                <span><strong>₹<?php echo number_format($subTotal, 2); ?></strong></span>
                            </li>
                        </ul>

                        <button type="submit" name="checkout" class="btn btn-primary btn-lg btn-block">
                            Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




</section>

<script>



        // Function to handle logout
        function logout() {
            // Send a GET request to the same page with a logout parameter
            window.location.href = "store.php?logout=true";
        }

        // Add event listener to the cart link
        // document.getElementById('cart-link').addEventListener('click', function(event) {
        //     // Prevent default action (i.e., following the link)
        //     event.preventDefault();

        //     // Check if user is logged in
        //     <?php if(!$loggedIn): ?>
        //         // If user is not logged in, display the login message
        //         alert("Please login to use the cart");
        //     <?php else: ?>
        //         // If user is logged in, proceed with the cart functionality
        //         window.location.href = "cart.php";
        //     <?php endif; ?>
        // });



        document.addEventListener('DOMContentLoaded', function() {
  document.querySelector('[name="checkout"]').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    fetch('cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: 'checkout=true', // Send a parameter to indicate checkout action
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Failed to checkout');
      }
      return response.text();
    })
    .then(data => {
      // Show the success alert
      document.getElementById('successAlert').classList.remove('d-none');
      console.log('Checkout successful');
      
      // Reload the page after 2 seconds
      setTimeout(function() {
        window.location.reload();
      }, 2000); // Adjust the timeout value as needed
    })
    .catch(error => {
      console.error('Error during checkout:', error);
    });
  });
});




// document.addEventListener('DOMContentLoaded', function() {
//         document.querySelector('[name="checkout"]').addEventListener('click', function(event) {
//             event.preventDefault(); // Prevent default form submission
            
//             fetch('cart.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded',
//                 },
//                 body: 'checkout=true', // Send a parameter to indicate checkout action
//             })
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error('Failed to checkout');
//                     }
//                     return response.text();
                    
//                 })
//                 .then(data => {
//                     // // Optionally, display a success message or redirect the user
//                     // console.log('Checkout successful');
//                     // window.location.reload(); // Reload the page after successful checkout
//                     // Show the success alert
//                     document.getElementById('successAlert').classList.remove('d-none');
//                     console.log('Checkout successful');
                    
//                     // Reload the page after 3 seconds
//                     setTimeout(function() {
//                         window.location.reload();
//                     }, 3000); // Adjust the timeout value as needed
//                     })
//                 })
//                 .catch(error => {
//                     console.error('Error during checkout:', error);
//                 });
//         });
//     });

    // Add event listener to update quantity buttons
    document.querySelectorAll('.update-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.productId;
            const action = this.dataset.action;

            fetch('cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `update_product_id=${productId}&action=${action}`,
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update quantity');
                    }
                    return response.text();
                })
                .then(data => {
                    location.reload(); // Refresh the page
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                });
        });
    });
</script>

</body>
</html>

<?php
if(isset($_SESSION['user_id'])) {
    $result->free();
}

// Close connection
if(isset($_SESSION['user_id'])) {
    $conn->close();
}
?>
