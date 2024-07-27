<?php
// Start the session
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

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GetGreen</title>

    <link rel="shortcut icon" href="./img/plantiful-logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- -- Bootstrap css cdn -- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- -- Font Awesom cdn --  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

    <!-- -- CSS --  -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- loader section -->
    <div class="loader d-flex justify-content-center align-items-center">
        <div class="banana d">
        <svg class="logo" width="42px" height="27px" viewBox="0 0 42 27" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <path
            d="M27.2861584,12.161723 C21.878637,13.1079515 17.6922039,20.3685835 15.4747077,25.1841521 C13.3245071,4.20375459 42,0 42,0 C42,0 37.9221081,28.5085611 15.7102421,26.9373612 L27.2861584,12.161723 Z M9.68859135,25.3642259 L4.07597867,14.6643189 C3.16588397,18.4076368 6.95830724,23.2066496 9.14123129,25.5907604 C-4.2897248,21.7286768 1.04594976,3.21222934 1.04594976,3.21222934 C1.04594976,3.21222934 15.98106,12.9521138 9.68859135,25.3642259 Z"
            id="" fill="#00ba69"></path>
        </svg>
        </div>
    </div>
    <!-- end of loader section -->
    
    <!-- scrool top -->
    <a href="#" class="scrollTop" id="scrollTop">
        <i class="fas fa-arrow-up scrollTop-icon"></i>
    </a>
    <!-- end of scrool top -->

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
    <!-- End of Navbar Section -->


    <!-- Cart Section -->
    <div class="cart cart-container" id="cart">
        <!-- cart modal -->
        <div class="cart-modal">
            <!-- message -->
            <div>
                <div class="d-flex justify-content-center cart-notification">
                    <p class="font-weight-bold text-uppercase py-3 my-auto cart-added">
                        <i class="fas fa-check-circle text-success"></i>
                        Just added to your cart
                    </p>
                    <i class="fas fa-times-circle my-auto cart-close btn" id="cart-close"></i>
                </div>
                <p class="px-4 my-2" id="message">message</p>
            </div>
            <!-- end of message -->

            <!-- subtotal -->
            <div class="px-3 mt-3 d-flex justify-content-between" id="cart-subtotal-container">
                <p class="text-uppercase">
                    subtotal ( <span class="cart-item-number">2</span> item<span id="plural">s</span> )
                </p>
                <p class="font-weight-bold">₹<span id="cart-item-total">9.99</span></p>
            </div>
            <!-- end of subtotal -->

            <!-- cart buttons -->
            <div class="cart-buttons-container px-3 my-3">
                <a href="" class="w-100 my-2 btn btn-dark text-uppercase" id="clear-cart">view cart</a>
                <button class="w-100 btn btn-outline-dark text-uppercase continue-btn">continue shopping</button>
            </div>
            <!-- end of cart buttons -->
        </div>
        <!-- end of cart modal -->
    </div>
    <!-- end of Cart Section -->


    <!-- Store list Section -->
    <section class="store pt-5" id="store">
        <div class="container">
            <div class="row">
                <!-- categories -->
                <div class="col-md-2 filter" id="filter">
                    <h4 class="categories-heading text-capitalize font-weight-bold">
                        categories
                    </h4>
                    <ul class="nav d-flex flex-column text-capitalize">
                        <li class="filter-btn my-1" data-filter="all">all plants</li>
                        <li class="filter-btn my-1" data-filter="small">small</li>
                        <li class="filter-btn my-1" data-filter="medium">medium</li>
                        <li class="filter-btn my-1" data-filter="large">large</li>
                    </ul>
                </div>
                <!-- end of categories -->

                <!-- item list -->
                <div class="col-md-10 item-list" id="item-list">
                    <div class="container">
                        <h5 class="text-uppercase filtered-plants">all plants</h5>
                        <div class="row" id="store-container"></div>
                    </div>
                </div>
                <!-- end of item list -->
            </div>
        </div>
    </section>
    <!-- end of Store list Section -->


    <!-- Favourite Section -->
    <section class="favourite my-5" id="favourite">
        <div class="container">
            <div class="row">
                <div class="horizontal-line"></div>
                <h1 class="text-uppercase mx-auto my-4">our best sellers</h1>
            </div>

            <div class="row mx-auto my-auto" id="favourite-info">
                <!-- single item -->
                <div class="col-md-3 col-6">
                    <div class="card plant-card">
                        <div class="plant-img-div">
                            <img src="./img/small-1.jpg" alt="small-1">
                        </div>
                        <!-- card body -->
                        <div class="card-body px-0">
                            <div class="plant-info d-flex justify-content-between">
                                <!-- plant name -->
                                <div class="plant-text justify-content-start">
                                    <h6 class="text-capitalize">Lorem, ipsum.</h6>
                                </div>
                                <!-- plant price -->
                                <div class="plant-value align-self center">
                                    $<span class="plant-price">25</span>
                                </div>
                            </div>
                        </div>
                        <!-- end of card body -->
                    </div>
                </div>
                <!-- end of single item -->
            </div>
        </div>
    </section>
    <!-- end of Favourite Section -->





    <!-- Footer Section -->
    <footer class="footer py-5" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6 my-auto">
                    <div class="footer-text">
                        <h1 class="mb-3">Let's be friends.</h1>
                        <!-- form -->
                        <form action="">
                            <div class="input-group mb-3 footer-input">
                                <input type="text" placeholder="Enter your e-mail" class="form-control-dark p-2">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="button-addon2">Subscribe</button>
                                </div>
                            </div>
                        </form>

                        <!-- line -->
                        <div class="horizontal-line"></div>
                        
                        <!-- links -->
                        <div class="text-capitalize d-flex justify-content-between w-75">
                            <ul class="nav flex-column">
                                <li><a href="index.php" class="text-dark">home</a></li>
                                <li><a href="about.php" class="text-dark">about</a></li>
                                <li><a href="store.php" class="text-dark">store</a></li>
                                <li><a href="contact.php" class="text-dark">contact</a></li>
                            </ul>
                            <ul class="nav flex-column">
                                <li><a class="text-dark" href="https://instagram.com">instagram</a></li>
                                <li><a class="text-dark" href="https://facebook.com">facebook</a></li>
                                <li><a href="https://twitter.com" class="text-dark">twitter</a></li>
                                <li><a href="https://www.linkedin.com" class="text-dark">linked in</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-6 mt-2">
                    <div class="footer-img justify-content-center align-items-center">
                        <img src="./img/footer.jpg" alt="footer" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end of Footer Section -->
    






    <script>
        // Function to handle logout
        function logout() {
            // Send a GET request to the same page with a logout parameter
            window.location.href = "store.php?logout=true";
        }

        // Add event listener to the cart link
        document.getElementById('cart-link').addEventListener('click', function(event) {
            // Prevent default action (i.e., following the link)
            event.preventDefault();

            // Check if user is logged in
            <?php if(!$loggedIn): ?>
                // If user is not logged in, display the login message
                alert("Please login to use the cart");
            <?php else: ?>
                // If user is logged in, proceed with the cart functionality
                window.location.href = "cart.php";
            <?php endif; ?>
        });
    </script>


    <!-- -- Bootstrap JS cdn -- -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- -- JS -- -->
    <script type="module" src="js/store.js"></script>
    
</body>
</html>