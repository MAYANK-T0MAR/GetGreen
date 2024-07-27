<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: http://localhost/project1/supplier_login.html");
    exit();
}

$store_name = isset($_SESSION["store_name"]) ? $_SESSION["store_name"] : "";
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
$supplier_id = isset($_SESSION["supplier_id"]) ? $_SESSION["supplier_id"] : "";

// Logout functionality
function logout() {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: http://localhost/project1/supplier_login.html");
    exit;
}

// Check if logout link is clicked
if (isset($_GET['logout'])) {
    logout();
}



?>



<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>GetGreen - Insert Product</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

    *, body {
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
    }

    html, body {
        height: 100%;
        background-color: #152733;
    }


    .form-holder {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        min-height: 100vh;
    }

    .form-holder .form-content {
        position: relative;
        text-align: center;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-align-items: center;
        align-items: center;
        padding: 60px;
    }

    .form-content .form-items {
        border: 3px solid #fff;
        padding: 40px;
        display: inline-block;
        width: 100%;
        min-width: 840px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        text-align: left;
        -webkit-transition: all 0.4s ease;
        transition: all 0.4s ease;
    }

    .form-content h3 {
        color: #fff;
        text-align: left;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .form-content h3.form-title {
        margin-bottom: 30px;
    }

    .form-content p {
        color: #fff;
        text-align: left;
        font-size: 17px;
        font-weight: 300;
        line-height: 20px;
        margin-bottom: 30px;
    }


    .form-content label, .was-validated .form-check-input:invalid~.form-check-label, .was-validated .form-check-input:valid~.form-check-label{
        color: #fff;
    }

    .form-content input[type=text], .form-content input[type=password], .form-content input[type=email], .form-content select {
        width: 100%;
        padding: 9px 20px;
        text-align: left;
        border: 0;
        outline: 0;
        border-radius: 6px;
        background-color: #fff;
        font-size: 15px;
        font-weight: 300;
        color: #8D8D8D;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        margin-top: 16px;
    }


    .btn-primary{
        background-color: #ffffff;
        outline: none;
        border: 0px;
        box-shadow: none;
    }

    .btn-primary:hover, .btn-primary:focus, .btn-primary:active{
        background-color: #495056;
        outline: none !important;
        border: none !important;
        box-shadow: none;
    }

    .form-content textarea {
        position: static !important;
        width: 100%;
        padding: 8px 20px;
        border-radius: 6px;
        text-align: left;
        background-color: #fff;
        border: 0;
        font-size: 15px;
        font-weight: 300;
        color: #8D8D8D;
        outline: none;
        resize: none;
        height: 120px;
        -webkit-transition: none;
        transition: none;
        margin-bottom: 14px;
    }

    .form-content textarea:hover, .form-content textarea:focus {
        border: 0;
        background-color: #ebeff8;
        color: #8D8D8D;
    }

    .mv-up{
        margin-top: -9px !important;
        margin-bottom: 8px !important;
    }

    .invalid-feedback{
        color: #ff606e;
    }

    .valid-feedback{
    color: #2acc80;
    }
    </style>
</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		            <div class="search-mobile-trigger d-sm-none col">
			            <i class="search-mobile-trigger-icon fa-solid fa-magnifying-glass"></i>
			        </div><!--//col-->
		            
		            
		            <div class="app-utilities col-auto">
			            
			            
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
                        <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
							<i class="bi bi-person-fill"></i> <!-- Replace this with your desired icon class -->
						</a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<!-- <li><a class="dropdown-item" href="account.html">Account</a></li>
								<li><a class="dropdown-item" href="settings.html">Settings</a></li> -->
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="?logout=true">Log Out</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel sidepanel-hidden"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="orders.html"><img class="logo-icon me-2" src="../img/plantiful-logo-black.png" alt="logo"><span class="logo-text">GetGreen</span></a>
	
		        </div><!--//app-branding-->  
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
					    
					    
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="http://localhost/project1/Plants-store-master/portal-theme-bs5-master/orders.php">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-list" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
  <path fill-rule="evenodd" d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5z"/>
  <circle cx="3.5" cy="5.5" r=".5"/>
  <circle cx="3.5" cy="8" r=".5"/>
  <circle cx="3.5" cy="10.5" r=".5"/>
</svg>
						         </span>
		                         <span class="nav-link-text">Orders</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
					    <li class="nav-item has-submenu">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link submenu-toggle active" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="true" aria-controls="submenu-2">
						        <span class="nav-icon">
						        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
	</svg>
						         </span>
		                         <span class="nav-link-text">Products</span>
		                         <span class="submenu-arrow">
		                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
	</svg>
	                             </span><!--//submenu-arrow-->
					        </a><!--//nav-link-->
					        <div id="submenu-2" class="collapse submenu submenu-2 show" data-bs-parent="#menu-accordion">
						        <ul class="submenu-list list-unstyled">
							        <li class="submenu-item"><a class="submenu-link active" href="insert-product.php">Upload Product</a></li>
							        <li class="submenu-item"><a class="submenu-link" href="edit-product.php">Edit Product</a></li>
						        </ul>
					        </div>
					    </li><!--//nav-item-->
				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
			    
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4" style="background-color: #15A362;">
		    <div class="container-xl">
                <div class="form-body">
                    <div class="row">
                        <div class="form-holder">
                            <div class="form-content">
                                <div class="form-items">
                                    <h3>Upload Product</h3>
                                    <p>Fill in the data below.</p>
                                    <form action="../insertProduct.php" method="POST" class="requires-validation" novalidate>
                                        <div class="col-md-12">
                                            <label for="name">Name:</label>
                                            <input class="form-control" type="text" id="name" name="name" required>
                                            <div class="valid-feedback">Name field is valid!</div>
                                            <div class="invalid-feedback">Name field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="size">Size:</label>
                                            <input class="form-control" type="text" id="size" name="size" required>
                                            <div class="valid-feedback">Size field is valid!</div>
                                            <div class="invalid-feedback">Size field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="sizeDescription">Size Description:</label>
                                            <input class="form-control" type="text" id="sizeDescription" name="sizeDescription" required>
                                            <div class="valid-feedback">Size Description field is valid!</div>
                                            <div class="invalid-feedback">Size Description field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="img">Image URL:</label>
                                            <input class="form-control" type="text" id="img" name="img" required>
                                            <div class="valid-feedback">Image URL field is valid!</div>
                                            <div class="invalid-feedback">Image URL field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="price">Price:</label>
                                            <input class="form-control" type="number" id="price" name="price" min="0" step="0.01" required>
                                            <div class="valid-feedback">Price field is valid!</div>
                                            <div class="invalid-feedback">Price field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="best">Best:</label>
                                            <input type="checkbox" id="best" name="best">
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="featured">Featured:</label>
                                            <input type="checkbox" id="featured" name="featured">
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="description">Description:</label>
                                            <textarea id="description" name="description" class="form-control" required></textarea>
                                            <div class="valid-feedback">Description field is valid!</div>
                                            <div class="invalid-feedback">Description field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="light">Light:</label>
                                            <textarea id="light" name="light" class="form-control" required></textarea>
                                            <div class="valid-feedback">Light field is valid!</div>
                                            <div class="invalid-feedback">Light field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="col-md-12">
                                            <label for="care">Care:</label>
                                            <textarea id="care" name="care" class="form-control" required></textarea>
                                            <div class="valid-feedback">Care field is valid!</div>
                                            <div class="invalid-feedback">Care field cannot be blank!</div>
                                        </div>
                                    
                                        <div class="form-button mt-3">
                                            <button type="submit" name="insert_Product" class="btn btn-primary">Insert Product</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          

    <script>
        (function () {
            'use strict';
    
            const forms = document.querySelectorAll('.requires-validation');
    
            forms.forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
    
                    form.classList.add('was-validated');
                }, false);
    
                const formInputs = form.querySelectorAll('input, textarea, select');
                formInputs.forEach(function (input) {
                    input.addEventListener('input', function () {
                        validateField(input);
                    });
                });
            });
    
            function validateField(input) {
                if (input.checkValidity()) {
                    input.setCustomValidity('');
                    input.nextElementSibling.nextElementSibling.textContent = ''; // Clear error message
                } else {
                    input.setCustomValidity('Please fill out this field correctly.');
                    input.nextElementSibling.nextElementSibling.textContent = input.validationMessage; // Update error message
                }
    
                // Perform additional custom validations
                if (input.id === 'size') {
                    validateSize(input);
                } else if (input.id === 'price') {
                    validatePrice(input);
                } else if (input.id === 'img') {
                    validateImageURL(input);
                }
            }
    
            function validateSize(sizeInput) {
                const size = sizeInput.value.trim().toLowerCase();
                if (size !== '' && !['small', 'medium', 'large'].includes(size)) {
                    sizeInput.setCustomValidity('Size must be small, medium, or large.');
                    sizeInput.nextElementSibling.nextElementSibling.textContent = 'Size must be small, medium, or large.';
                } else {
                    sizeInput.setCustomValidity('');
                    sizeInput.nextElementSibling.nextElementSibling.textContent = ''; // Clear error message
                }
            }
    
            function validatePrice(priceInput) {
                const price = parseFloat(priceInput.value);
                if (!isNaN(price) && price >= 0) {
                    priceInput.setCustomValidity('');
                    priceInput.nextElementSibling.nextElementSibling.textContent = ''; // Clear error message
                } else {
                    priceInput.setCustomValidity('Price must be a valid number.');
                    priceInput.nextElementSibling.nextElementSibling.textContent = 'Price must be a valid number.';
                }
            }
    
            function validateImageURL(imgInput) {
                const url = imgInput.value.trim();
                const pattern = /^(ftp|http|https):\/\/[^ "]+$/;
    
                if (url !== '' && !pattern.test(url)) {
                    imgInput.setCustomValidity('Please enter a valid URL.');
                    imgInput.nextElementSibling.nextElementSibling.textContent = 'Please enter a valid URL.';
                } else {
                    imgInput.setCustomValidity('');
                    imgInput.nextElementSibling.nextElementSibling.textContent = ''; // Clear error message
                }
            }
        })();
    </script>
    
    
    
    
    

    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

