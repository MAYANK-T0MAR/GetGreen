<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: http://localhost/project1/supplier_login.html");
    exit();
}

$store_name = isset($_SESSION["store_name"]) ? $_SESSION["store_name"] : "";
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : "";
$supplier_id = isset($_SESSION["supplier_id"]) ? $_SESSION["supplier_id"] : "";

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
    <title>GetGreen - Supplier Panel</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers"> -->
    <!-- <meta name="author" content="Xiaoying Riley at 3rd Wave Media">     -->
    <link rel="shortcut icon" href="../img/plantiful-logo-black.png"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


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
					        <a class="nav-link active" href="orders.html">
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
					        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
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
					        <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">
						        <ul class="submenu-list list-unstyled">
							        <li class="submenu-item"><a class="submenu-link" href="http://localhost/project1/Plants-store-master/portal-theme-bs5-master/insert-product.php">Upload Product</a></li>
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
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Orders</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center" method="GET">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary">Search</button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary download-btn" href="#">
									    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
		  <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
		</svg>
									    Download CSV
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <!-- <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-received-tab" data-bs-toggle="tab" href="#orders-received" role="tab" aria-controls="orders-received" aria-selected="false">Received</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-packed-tab" data-bs-toggle="tab" href="#orders-packed" role="tab" aria-controls="orders-packed" aria-selected="false">Packed</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-shipped-tab" data-bs-toggle="tab" href="#orders-shipped" role="tab" aria-controls="orders-shipped" aria-selected="false">Shipped</a>
					<a class="flex-sm-fill text-sm-center nav-link" id="orders-delivered-tab" data-bs-toggle="tab" href="#orders-delivered" role="tab" aria-controls="orders-delivered" aria-selected="false">Delivered</a>
					<a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Cancelled</a>
				</nav> -->
				
				
				<div class="tab-content" id="orders-table-tab-content">
					<div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
						<div class="app-card app-card-orders-table shadow-sm mb-5">
							<div class="app-card-body">
								<div class="table-responsive">
									<table id="orders-table" class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">ID</th>
												<th class="cell">User Name</th>
												<th class="cell">User address</th>
												<th class="cell">Product Name</th>
												<th class="cell">Price</th>
												<th class="cell">Quantity</th>
												<th class="cell">Total Price</th>
												<th class="cell">Order Date</th>
												<th class="cell">Status</th>
											</tr>
										</thead>
										<tbody>
											<!-- Data rows will go here dynamically -->
											<?php
											// MySQL database configuration
											$servername = "localhost: 3306"; // Change this to your MySQL server hostname
											$username = "root"; // Change this to your MySQL username
											$password = ""; // Change this to your MySQL password
											$database = "test1"; // Change this to your MySQL database name

											// Create connection
											$conn = new mysqli($servername, $username, $password, $database);

											// Check connection
											if ($conn->connect_error) {
												die("Connection failed: " . $conn->connect_error);
											}

											// Handle status update if form submitted
											if ($_SERVER["REQUEST_METHOD"] == "POST") {
												$order_id = $_POST['order_id'];
												$new_status = $_POST['new_status'];

												// Update status in the database
												$update_sql = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
												if ($conn->query($update_sql) === TRUE) {
													echo "";
												} else {
													echo "Error updating status: " . $conn->error;
												}
											}

											// SQL query to retrieve data from the orders table
											$sql = "SELECT o.id, r1.firstName, r1.lastName, r1.address, p.name AS product_name, o.price, o.quantity, o.total_price, o.order_date, o.status
													FROM orders o
													INNER JOIN registration1 r1 ON o.user_id = r1.id
													INNER JOIN plants p ON o.product_id = p.id
													INNER JOIN suppliers s ON p.supplier_id = s.id
													WHERE s.id = $supplier_id";
											// Check if a search query is provided
											if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['searchorders'])) {
												$search_query = $_GET['searchorders'];
												// Modify the SQL query to include the search logic
												$sql .= " AND (
													o.id LIKE '%$search_query%' OR 
													r1.firstName LIKE '%$search_query%' OR 
													r1.lastName LIKE '%$search_query%' OR 
													p.name LIKE '%$search_query%' OR 
													o.status LIKE '%$search_query%' OR 
													CAST(o.price AS CHAR) LIKE '%$search_query%' OR 
													CAST(o.order_date AS CHAR) LIKE '%$search_query%'
												)";
											}


											$result = $conn->query($sql);

											if ($result->num_rows > 0) {
												// Output data of each row
												while($row = $result->fetch_assoc()) {
													echo "<tr>";
													echo "<td class='cell'>" . $row["id"] . "</td>";
													echo "<td class='cell'>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
													echo "<td class='cell'>" . $row["address"] . "</td>";
													echo "<td class='cell'>" . $row["product_name"] . "</td>";
													echo "<td class='cell'>" . $row["price"] . "</td>";
													echo "<td class='cell'>" . $row["quantity"] . "</td>";
													echo "<td class='cell'>" . $row["total_price"] . "</td>";
													echo "<td class='cell'>" . $row["order_date"] . "</td>";
													// echo "<td class='cell'>" . $row["status"] . "</td>";
													// Display status with appropriate badge color
													echo "<td class='cell'>";
													switch ($row["status"]) {
														case "received":
															echo "<span class='badge bg-secondary'>" . $row["status"] . "</span>";
															break;
														case "packed":
															echo "<span class='badge bg-info text-dark'>" . $row["status"] . "</span>";
															break;
														case "shipped":
															echo "<span class='badge bg-warning'>" . $row["status"] . "</span>";
															break;
														case "delivered":
															echo "<span class='badge bg-success'>" . $row["status"] . "</span>";
															break;
														case "cancelled":
															echo "<span class='badge bg-danger'>" . $row["status"] . "</span>";
															break;
														default:
															echo $row["status"];
													}
													echo "</td>";

													// Edit button (only render if status is not delivered)
													if ($row["status"] != "delivered"&& $row["status"] != "cancelled") {
														echo "<td class='cell'><button class='edit-btn' data-order-id='" . $row["id"] . "' data-order-status='" . $row["status"] . "'>Edit</button></td>";
													}
													echo "</tr>";
												}
											} else {
												echo "0 results";
											}
											$conn->close();
											?>

											<!-- Modal for status edit -->
											<div id="editModal" class="modal" style="background-color: #060606c2;width: 100%;height: 100%;padding: 10%;display: none;align-items: center;justify-content: center;right: 50%;" >
												<div class="modal-content" style="padding: 30px;width: 35%;left: 33%;top: 20%;margin: 30px;">
													<span class="close" style="color: white;cursor:pointer;width: 15px;position: absolute;font-size: xxx-large;bottom: 210%;right: 225%;">&times;</span>
													<h2>Edit Order Status</h2>
													<form id="editForm" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
														<input type="hidden" id="order_id" name="order_id">
														<label for="new_status">New Status:</label>
														<select id="new_status" name="new_status" style="margin: 10px;padding: 5px;border-radius: 8px;">
															<option value="received">Received</option>
															<option value="packed">Packed</option>
															<option value="shipped">Shipped</option>
															<option value="delivered">Delivered</option>
														</select>
														<button type="submit" style="padding: 5px;border: 2px solid green;border-radius: 15px;">Update</button>
													</form>
												</div>
											</div>
										</tbody>
									</table>
								</div><!--//table-responsive-->
							</div><!--//app-card-body-->
						</div><!--//app-card-->
					</div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->     
	
	<!-- <script>
// Get the modal
var modal = document.getElementById('editModal');

// Get the button that opens the modal
var btns = document.querySelectorAll('.edit-btn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btns.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var orderId = this.getAttribute('data-order-id');
        document.getElementById('order_id').value = orderId;
        modal.style.display = "block";
    });
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
 -->



 <script>
// Get the modal
var modal = document.getElementById('editModal');

// Get the button that opens the modal
var btns = document.querySelectorAll('.edit-btn');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btns.forEach(function(btn) {
    btn.addEventListener('click', function() {
        var orderId = this.getAttribute('data-order-id');
        var status = this.getAttribute('data-order-status');
        document.getElementById('order_id').value = orderId;
        // Check the current status to determine which options to enable
        var select = document.getElementById('new_status');
        select.disabled = false;
        select.innerHTML = ''; // Clear previous options
        switch(status) {
            case 'received':
                select.options.add(new Option('Packed', 'packed'));
                select.options.add(new Option('Shipped', 'shipped'));
                select.options.add(new Option('Delivered', 'delivered'));
                break;
            case 'packed':
                select.options.add(new Option('Shipped', 'shipped'));
                select.options.add(new Option('Delivered', 'delivered'));
                break;
            case 'shipped':
                select.options.add(new Option('Delivered', 'delivered'));
                break;
            case 'delivered':
                select.disabled = true; // Disable select if already delivered
                break;
            default:
                // Handle default case here
        }
        modal.style.display = "block";
    });
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}




document.addEventListener('DOMContentLoaded', function() {
        const downloadButton = document.querySelector('.download-btn');
        const table = document.getElementById('orders-table');

        downloadButton.addEventListener('click', function() {
            const csv = [];

            // Add table headers to CSV
            const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent);
            csv.push(headers.join(','));

            // Add table rows to CSV
            const rows = Array.from(table.querySelectorAll('tbody tr')).map(row => {
                return Array.from(row.querySelectorAll('td')).map(td => td.textContent).join(',');
            });
            csv.push(...rows);

            // Create a Blob containing the CSV data
            const csvData = new Blob([csv.join('\n')], { type: 'text/csv' });

            // Create a link element to trigger the download
            const link = document.createElement('a');
            link.href = URL.createObjectURL(csvData);
            link.download = 'orders.csv';

            // Simulate a click event to trigger the download
            link.click();
        });
    });



</script>




    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
    
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

