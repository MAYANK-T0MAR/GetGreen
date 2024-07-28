# GetGreen - Plant Store Website

## Overview

GetGreen is a comprehensive plant store website designed to enhance the shopping experience for plant enthusiasts. It provides a modern, user-friendly interface with robust features for browsing, purchasing, and managing plants.

## Features

- **Home Page**: Showcases featured plants and promotions.
- **Plant Catalog**: Browse through various plants with detailed information, including images, descriptions, and care instructions.
- **Search and Filtering**: Efficiently find plants by size.
- **Product Details**: View detailed information about each plant, including price, description, and availability.
- **Shopping Cart**: Add plants to the cart, view cart contents, and proceed to checkout.
- **User Authentication**: Register, log in, and manage user accounts.
- **Order Management**: View order history and track current orders.
- **Responsive Design**: Optimized for both desktop and mobile devices to ensure a seamless experience.

## Validation Testing

### Supplier

- **Login/Signup**:
  - Verify that the supplier can log in or register using valid credentials.
  - Ensure redirection to the supplier dashboard upon successful login.
  - Unauthorized access should be redirected to the login page.

- **Orders**:
  - Suppliers should be able to browse orders, view customer information, and download a CSV of orders.
  - Ensure suppliers can change order statuses, with changes reflected in the user’s “My Orders” section.

- **Products**:
  - Suppliers should be able to upload new products, which appear in the store immediately.
  - Suppliers can view and edit their products.
  - Orders and product information should be visible only to the respective supplier.

- **Logout**:
  - Verify the logout functionality. After logout, suppliers should not access the supplier dashboard by using the back button.

### User

- **Login/Signup**:
  - Users should be able to log in or register using valid credentials.
  - Upon successful login, users should be redirected to the home page.
  - Unauthorized access should be redirected to the login page.
  - Ensure that only logged-in users can access the cart.

- **Store**:
  - Users should be able to access and filter plant information based on size (small, medium, large).

- **Cart**:
  - Users can add products to the cart, with quantities updated correctly for duplicate items.
  - Users should be able to view and modify cart contents, and place orders.
  - Items should be removed from the cart after an order is placed.

- **My Orders**:
  - Users can view their order history, check order status, and cancel orders.
  - Price changes after an order should not affect the order details in the order history.
  - Order information should be visible only to the respective user.

## Installation

To set up GetGreen locally using XAMPP, follow these instructions:

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/MAYANK-T0MAR/GetGreen.git
    cd GetGreen
    ```

2. **Move Files to XAMPP Directory:**

    - Make a "project1" folder in your htdocs of XAMPP folder (i.e. C:\xampp\htdocs\project1).
    - Copy the contents to the `project1` folder inside your XAMPP installation folder (e.g., `C:\xampp\htdocs\project1`).
    - It is important that you make the "project1" folder and copy all the content in that folder specifically.
      
3. **Set Up Database:**

    - Open phpMyAdmin via XAMPP (usually accessible at `http://localhost/phpmyadmin`).
    - Create a new database named `test1`.
    - Import the SQL schema file (named `test1`) into this database.


5. **Start XAMPP Services:**

    - Open the XAMPP Control Panel and start the Apache and MySQL services.

6. **Access the Website:**

    - Open your web browser and navigate to `http://localhost/project1/Plants-store-master/index.php`.
