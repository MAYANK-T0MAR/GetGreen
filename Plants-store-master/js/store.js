
// import { showCartModal, showTotals } from "./cart.js";
import CreatePlants from "./createPlant.js";

window.addEventListener("load", () =>
  document.querySelector(".loader").classList.add("hideLoader")
);

function scrollTop() {
  let scrollTop = document.querySelector("#scrollTop");

  if (this.scrollY >= 400) {
    scrollTop.classList.add("show-arrow");
  } else {
    scrollTop.classList.remove("show-arrow");
  }
}
window.addEventListener("scroll", scrollTop);

const displayBestSellers = (plants) => {
  const bestSellers = plants.bestSellers;

  const favouriteInfo = document.getElementById("favourite-info");

  favouriteInfo.innerHTML = "";

  let data = "";
  bestSellers.forEach((best) => {
    data += `
      <!-- single item -->
      <div class="col-md-3 col-6">
        <div class="card plant-card">
          <div class="plant-img-div">
            <a href="product.php?id=${best.id}" id="singlePlantLink">
              <img src="${best.img}" alt="plant" class="card-img-top plant-img">
            </a>
            <button class="btn btn-outline-dark add-btn" id="open">add to cart</button>
          </div>
          <!-- card body -->
          <div class="card-body px-0">
          <div class="plant-info d-flex justify-content-between">
            <!-- first flex child -->
            <div class="plant-text justify-content-start">
              <h6 class="text-muted"></h6>
              <a href="product.php?id=${best.id}" class="text-dark">
               <h5 class="text-capitalize plant-name">${best.name}</h5>
              </a>
            </div>
            <!-- second flex child -->
            <div class="plant-value align-self-center">
            ₹<span class="plant-price">${best.price}</span>
            </div>
          </div>
        </div>
          <!-- end of card body -->
        </div>
      </div>
      <!-- end of single item -->`;
  });
  favouriteInfo.innerHTML = data;
};

const displayPlants = (plants) => {
  const plantsToDisplay = plants.plants;
  const store = document.getElementById("store-container");

  store.innerHTML = "";
  let data = "";

  plantsToDisplay.forEach((plant) => {
    data += `
      <!-- single item -->
      <div class="col-sm-6 col-lg-4 single-plant ${plant.size}">
        <div class="card plant-card">
          <div class="plant-img-div">
           <a href="product.php?id=${plant.id}" id="singlePlantLink">
             <img src="${plant.img}" alt="plant" class="card-img-top plant-img">
           </a>
            <button class="btn btn-outline-dark add-btn" id="open">add to cart</button>
          </div>
          <!-- card body -->
          <div class="card-body px-0">
            <div class="plant-info d-flex justify-content-between">
              <!-- first flex child -->
              <div class="plant-text justify-content-start">
                <h6 class="text-muted">${plant.sizeDescription}</h6>
                <a href="product.php?id=${plant.id}" class="text-dark">
                 <h5 class="text-capitalize plant-name">${plant.name}</h5>
                </a>
              </div>
              <!-- second flex child -->
              <div class="plant-value align-self-center">
              ₹<span class="plant-price">${plant.price}</span>
              </div>
            </div>
          </div>
          <!-- end of card body -->
        </div>
      </div>
      <!-- end of single item -->`;
  });

  store.innerHTML = data;
  // showCartModal();
  addToCart();
};

const filterPlants = () => {
  const filterBtns = document.querySelectorAll(".filter-btn");
  const filterTitle = document.querySelector(".filtered-plants");

  filterBtns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      const value = e.target.dataset.filter;
      const singlePlant = document.querySelectorAll(".single-plant");

      singlePlant.forEach((plant) => {
        if (value === "all") {
          plant.style.display = "block";
        } else {
          !plant.classList.contains(value)
            ? (plant.style.display = "none")
            : (plant.style.display = "block");
        }
      });

      filterTitle.textContent = value;
    });
  });
};


// const addToCart = () => {
//   const openButtons = document.querySelectorAll("#open");

//   openButtons.forEach((button) => {
//     button.addEventListener("click", (e) => {
//       if (e.target.parentElement.classList.contains("plant-img-div")) {
//         let fullPath = e.target.parentElement.children[0].children[0].src;
//         let name = e.target.parentElement.parentElement.children[1].children[0].children[0].children[1].children[0].textContent;
//         let price = +e.target.parentElement.parentElement.children[1].children[0].children[1].children[0].textContent;

//         const existingCartItem = document.querySelector(`.cart-modal .cart-item[data-name="${name}"]`);

//         if (existingCartItem) {
//           // If exists, increase the quantity
//           const quantityElement = existingCartItem.querySelector('#cart-item-qty');
//           let quantity = parseInt(quantityElement.textContent);
//           quantity++;
//           quantityElement.textContent = quantity;
//         } else {
//           // If not, create a new cart item
//           const cartItem = document.createElement("div");
//           cartItem.className = "cart-item d-flex pb-3";
//           cartItem.setAttribute('data-name', name);

//           cartItem.innerHTML = `
//             <img src="${fullPath}" class="img-fluid mx-3" alt="plant" style="width:70px;height:70px">
//             <div class="item-text ">
//               <p class="text-uppercase font-weight-bold  m-0 p-0" id="cart-item-title">${name}</p>
//               <p class="font-weight-bold m-0 p-0">₹<span id="cart-item-price">${price}</span></p>
//               <p class="m-0 p-0">qty: <span id="cart-item-qty">1</span>
//               </p>
//             `;

//           const cartModal = document.querySelector(".cart-modal");
//           const total = document.querySelector("#cart-subtotal-container");

//           cartModal.insertBefore(cartItem, total);
//         }

//         showTotals(); // Update cart totals
//       }
//     });
//   });
// };


const addToCart = () => {
  const addButtons = document.querySelectorAll(".add-btn");

  addButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      // Prevent default form submission
      event.preventDefault();

      // Get product ID from the URL of the anchor tag
      const productUrl = button.parentElement.querySelector("#singlePlantLink").getAttribute("href");
      const urlParams = new URLSearchParams(productUrl.split('?')[1]);
      const productId = urlParams.get("id");

      // Send AJAX request to add product to cart
      fetch('../add_to_cart.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          productId: productId
        })
      })
      .then(response => response.json())
      .then(data => {
        // Handle response
        console.log(data);
        // Optionally, update UI to reflect cart changes
      })
      .catch(error => {
        // Handle error
        console.error('Error:', error);
      });
    });
  });
};

// Call the function to initialize add to cart functionality
addToCart();





// Fetch data from PHP file
fetch("data/get_plants.php") // the server file 
  .then((response) => {
    return response.json();
  })

  
  .then((data) => {
    // data.forEach((plant) => {
    //   const imgElement = document.createElement("img");
    //   imgElement.src = plant.img; // Use the image URL directly from the 'img' field
    //   // Append imgElement to the appropriate container in your HTML
    // });
    const plants = CreatePlants(data.data);
    displayBestSellers(plants);
    displayPlants(plants);
    filterPlants();
  });
