// import { showCartModal, showTotals } from "./cart.js";
import CreatePlants from "./createPlant.js";

// show loader when loading
window.addEventListener("load", () =>
  document.querySelector(".loader").classList.add("hideLoader")
);

// Scroll Top
function scrollTop() {
  let scrollTop = document.querySelector("#scrollTop");

  if (this.scrollY >= 400) {
    scrollTop.classList.add("show-arrow");
  } else {
    scrollTop.classList.remove("show-arrow");
  }
}
window.addEventListener("scroll", scrollTop);

// get query strings
const urlParams = new URLSearchParams(window.location.search);
const urlId = urlParams.get("id");

const displayProduct = (plantData) => {
  const singlePlant = document.querySelector("#singlePlant");
  singlePlant.innerHTML = "";

  plantData.plants.forEach((plant) => {
    if (plant.id == urlId) {
      singlePlant.innerHTML = `
      <div class="col-md-5">
        <div class="product-img">
          <img src="${plant.img}" class="img-fluid mb-3" alt="plant product">
        </div>
      </div>
      <div class="col-md-6 col-sm-9 col-11 mx-auto">
        <div class="product-content mb-5">
          <h1 class="text-capitalize mb-3">${plant.name}</h1>
          <h4>₹<span>${plant.price}</span></h4>
          <h5>Get a taste of the tropical forest</h5>
        </div>
        <!-- first line -->
        <div class="product-description d-flex mb-4">
          <i class="fas fa-ruler-vertical mr-4 align-self-center fa-2x fa-fw ruler"></i>
        <div class="">
          <p class="text-muted text-uppercase p-0 m-0">pot & plant combined size</p>
          <p class="m-0">${plant.sizeDescription}</p>
        </div>
      </div>
      <!-- end of first line -->
      <!-- second line -->
      <div class="product-description d-flex mb-4">
        <i class="fas fa-sun mr-4 align-self-center fa-fw fa-2x p-1 sun"></i>
        <div class="">
          <p class="text-muted text-uppercase p-0 m-0">light</p>
          <p class="m-0">${plant.light}</p>
        </div>
      </div>
      <!-- end of second line -->
      <!-- third line -->
      <div class="product-description d-flex">
        <i class="fas fa-hand-holding-heart fa-2x mr-4 align-self-center fa-fw p-1 holding-heart"></i>
        <div class="">
          <p class="text-muted text-uppercase p-0 m-0">care</p>
          <p class="m-0">${plant.care}</p>
        </div>
      </div>
      <!-- end of third line -->
      <button class="product-btn w-100 my-5 mx-auto btn btn-lg btn-dark text-capitalize" id="open">Add to cart</button>
      <div class="shipping-guide d-flex justify-content-between" data-toggle="modal"
        data-target="#shipping-guideScrollable">
        <p class="text-capitalize mt-2 my-2 align-self-center">shipping guide</p>
        <i class="fas fa-plus align-self-center"></i>
      </div>
    </div>
      `;
    }
  });

  // showCartModal();
  addToCart();
};

// Best seller plants
// const displayBestSellers = (plants) => {
//   const bestSellers = plants.bestSellers;

//   const favouriteInfo = document.getElementById("favourite-info");

//   favouriteInfo.innerHTML = "";

//   let data = "";
//   bestSellers.forEach((best) => {
//     data += `
//       <!-- single item -->
//       <div class="col-md-3 col-6">
//         <div class="card plant-card">
//           <div class="plant-img-div">
//             <a href="product.php?id=${best.id}" id="singlePlantLink">
//               <img src="${best.img}" alt="plant" class="card-img-top plant-img">
//             </a>
//             <button class="btn btn-outline-dark add-btn" id="open">add to cart</button>
//           </div>
//           <!-- card body -->
//           <div class="card-body px-0">
//           <div class="plant-info d-flex justify-content-between">
//             <!-- first flex child -->
//             <div class="plant-text justify-content-start">
//               <h6 class="text-muted"></h6>
//               <a href="product.php?id=${best.id}" class="text-dark">
//                <h5 class="text-capitalize plant-name">${best.name}</h5>
//               </a>
//             </div>
//             <!-- second flex child -->
//             <div class="plant-value align-self-center">
//               ₹<span class="plant-price">${best.price}</span>
//             </div>
//           </div>
//         </div>
//           <!-- end of card body -->
//         </div>
//       </div>
//       <!-- end of single item -->`;
//   });
//   favouriteInfo.innerHTML = data;
//   // showCartModal();
//   addToCart();
// };


function addToCart() {
  // Add event listener for the main "Add to cart" button
  const mainButton = document.querySelector("#open");
  if (mainButton) {
    mainButton.addEventListener("click", handleMainAddToCartClick);
  }

  // Add event listener for the "Add to cart" buttons in the best seller section
  const bestSellerButtons = document.querySelectorAll(".plant-card");
  bestSellerButtons.forEach((button) => {
    button.addEventListener("click", handleBestSellerAddToCartClick);
  });
}

function handleMainAddToCartClick(event) {
  // Prevent default button behavior
  event.preventDefault();

  // Get the product id from the URL
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get("id");

  // Send a request to the server to add the product to the cart
  fetch("../add_to_cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      productId: productId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to add product to cart");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      // If the request is successful, update the UI or show a success message
    })
    .catch((error) => {
      console.error("Error adding product to cart:", error);
      // Handle errors or show an error message
    });
}

function handleBestSellerAddToCartClick(event) {
  // Prevent default button behavior
  event.preventDefault();

  // Get the product id from the button's href attribute
  const productId = this.querySelector('a').getAttribute('href').split('=')[1];

  // Send a request to the server to add the product to the cart
  fetch("../add_to_cart.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      productId: productId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Failed to add product to cart");
      }
      return response.json();
    })
    .then((data) => {
      console.log(data);
      // If the request is successful, update the UI or show a success message
    })
    .catch((error) => {
      console.error("Error adding product to cart:", error);
      // Handle errors or show an error message
    });
}

// Call the addToCart function after the DOM is loaded
document.addEventListener("DOMContentLoaded", addToCart);



fetch("data/get_plants.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    const plants = CreatePlants(data.data);
    displayProduct(plants);
    displayBestSellers(plants);
  });
