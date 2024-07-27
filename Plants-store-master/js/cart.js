// // ===>> cart modale
// export const showCartModal = () => {
//   const close = document.getElementById("cart-close");
//   const open = document.querySelectorAll("#open");
//   const cartModal = document.getElementById("cart");
//   const continueBtn = document.querySelector(".continue-btn");

//   //   show modal
//   open.forEach((btn) => {
//     btn.addEventListener("click", () => {
//       cartModal.classList.add("show-cart-modal");
//     });
//   });

//   //   remove modal
//   close.addEventListener("click", () => {
//     cartModal.classList.remove("show-cart-modal");
//   });
//   continueBtn.addEventListener("click", () => {
//     cartModal.classList.remove("show-cart-modal");
//   });

//   window.addEventListener("click", (e) =>
//     e.target === cartModal
//       ? cartModal.classList.remove("show-cart-modal")
//       : false
//   );
// };

// // ===>> total info
// export const showTotals = () => {
//   const total = [];

//   const items = document.querySelectorAll("#cart-item-price");
//   items.forEach((item) => {
//     total.push(+item.textContent);
//   });

//   //   calculating price
//   const totalMoney = total.reduce((acc, item) => {
//     acc += item;
//     return acc;
//   }, 0);

//   const finalMoney = totalMoney.toFixed(2);

//   //   update total price
//   document.querySelector("#cart-item-total").textContent = finalMoney;

//   //   update number of item(s)
//   document.querySelectorAll(".cart-item-number").forEach((num) => {
//     num.textContent = total.length;
//   });

//   //   adding (s) depending on num of items added to the cart
//   const plural = document.querySelector("#plural");
//   total.length <= 1
//     ? (plural.style.desplay = "none")
//     : (plural.style.desplay = "inline-block");

//   // show free shipping message depending on finalMoney
//   const message = document.querySelector("#message");
//   finalMoney >= 100
//     ? (message.textContent =
//         "Congratulation! Your Order Qualifies of FREE SHIPPING.")
//     : (message.textContent = `You are ₹${
//         100 - finalMoney
//       } away from FREE SHIPPING`);
// };


/**-----------------1st revision starts here-------------------------**/

// // ===>> cart modal
// export const showCartModal = () => {
//   const close = document.getElementById("cart-close");
//   const open = document.querySelectorAll("#open");
//   const cartModal = document.getElementById("cart");
//   const continueBtn = document.querySelector(".continue-btn");

//   //   show modal
//   open.forEach((btn) => {
//     btn.addEventListener("click", () => {
//       cartModal.classList.add("show-cart-modal");
//     });
//   });

//   //   remove modal
//   close.addEventListener("click", () => {
//     cartModal.classList.remove("show-cart-modal");
//   });
//   continueBtn.addEventListener("click", () => {
//     cartModal.classList.remove("show-cart-modal");
//   });

//   window.addEventListener("click", (e) =>
//     e.target === cartModal
//       ? cartModal.classList.remove("show-cart-modal")
//       : false
//   );
// };


// export const showTotals = () => {
//   const cartItems = {}; // Object to store cart items and their quantities

//   const items = document.querySelectorAll(".cart-item");
//   items.forEach((item) => {
//     const itemName = item.dataset.name;
//     const itemPrice = +item.querySelector("#cart-item-price").textContent;
//     const itemQuantity = +item.querySelector("#cart-item-qty").textContent;
    
//     // Check if item already exists in the cart
//     if (cartItems[itemName]) {
//       // If exists, increase quantity
//       cartItems[itemName].quantity += itemQuantity;
//       cartItems[itemName].price += itemPrice * itemQuantity;
//     } else {
//       // If not, add it to the cart
//       cartItems[itemName] = {
//         quantity: itemQuantity,
//         price: itemPrice * itemQuantity
//       };
//     }
//   });

//   //   calculating total price
//   const totalMoney = Object.values(cartItems).reduce((acc, item) => {
//     acc += item.price;
//     return acc;
//   }, 0);

//   const finalMoney = totalMoney.toFixed(2);

//   //   update total price
//   document.querySelector("#cart-item-total").textContent = finalMoney;

//   //   update number of item(s)
//   const totalItems = Object.values(cartItems).reduce((acc, item) => {
//     acc += item.quantity;
//     return acc;
//   }, 0);
//   document.querySelectorAll(".cart-item-number").forEach((num) => {
//     num.textContent = totalItems;
//   });

//   //   adding (s) depending on num of items added to the cart
//   const plural = document.querySelector("#plural");
//   plural.style.display = totalItems <= 1 ? "none" : "inline-block";

//   // show free shipping message depending on finalMoney
//   const message = document.querySelector("#message");
//   finalMoney >= 100
//     ? (message.textContent =
//         "Congratulations! Your Order Qualifies for FREE SHIPPING.")
//     : (message.textContent = `You are ₹${(100 - finalMoney).toFixed(
//         2
//       )} away from FREE SHIPPING`);
// };


/**-----------------1st revision starts here-------------------------**/


// const addToCart = () => {
//   const addButtons = document.querySelectorAll(".add-btn");

//   addButtons.forEach((button) => {
//     button.addEventListener("click", (event) => {
//       // Prevent default form submission
//       event.preventDefault();

//       // Get product details from the clicked button
//       const productElement = event.target.closest('.plant-card');
//       const productId = productElement.dataset.productId;
//       const productName = productElement.querySelector('.plant-name').textContent;
//       const productPrice = parseFloat(productElement.querySelector('.plant-price').textContent.replace(/[^0-9.]/g, '')); // Extract numerical price from text

//       // Send AJAX request to add product to cart
//       fetch('add_to_cart.php', {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({
//           productId: productId,
//           productName: productName,
//           productPrice: productPrice
//         })
//       })
//       .then(response => response.json())
//       .then(data => {
//         // Handle response
//         console.log(data);
//         // Optionally, update UI to reflect cart changes
//       })
//       .catch(error => {
//         // Handle error
//         console.error('Error:', error);
//       });
//     });
//   });
// };

// // Call the function to initialize add to cart functionality
// addToCart();
