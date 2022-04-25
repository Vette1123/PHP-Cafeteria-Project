function decrement(e) {
    const product_id = parseInt(e.target.parentElement.parentElement.getAttribute("product"));
    removeElementFromCart(product_id);
  }
  
  function increment(e) {
    const product_id = parseInt(e.target.parentElement.parentElement.getAttribute("product"));
    increaseItemByOne(product_id);
  }

  function remove(e){
      const product_id = parseInt(e.target.parentElement.parentElement.getAttribute("product"));
      console.log(product_id);
      deleteItemFromCart(product_id);
  }

  function change(e){
    const product_id = parseInt(e.target.parentElement.parentElement.getAttribute("product"));
    setCartItemValue(product_id, +e.target.value);
  }

let cart = [];



function populatCartItems(){
    const cartItemsSection = document.querySelector('.cart-items');
    updatePrice();
    cart.forEach(item => {
        const productDiv = document.createElement('div');
        productDiv.className= 'form-controls', 'p-2', 'flex', 'items-center', 'mb-3';
        productDiv.setAttribute('product', item.product_id);

        const productLabel = document.createElement('label');
        productLabel.textContent = item.product_name;
        productLabel.classList.add("mr-auto");

        const counterDiv = document.createElement('div');
        counterDiv.classList.add('counter', 'ml-6', 'flex');
        

        const decreamentBtn = document.createElement('button');
        decreamentBtn.className = "bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-10 w-10 rounded-l cursor-pointer outline-none";
        decreamentBtn.setAttribute("type", "button");
        decreamentBtn.setAttribute("data-action", "decrement");
        decreamentBtn.addEventListener('click', decrement);
        decreamentBtn.innerHTML = '<span class="m-auto text-2xl font-thin">−</span>';

        const increamentBtn = document.createElement('button');
        increamentBtn.className = "bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-10 w-10 rounded-l cursor-pointer outline-none";
        increamentBtn.setAttribute("type", "button");
        increamentBtn.setAttribute("data-action", "increment");
        increamentBtn.addEventListener('click', increment);
        increamentBtn.innerHTML = '<span class="m-auto text-2xl font-thin">+</span>';

        const counterInput =  document.createElement('input');
        counterInput.className = "outline-none focus:outline-none text-center w-10 bg-gray-300 font-semibold text-md hover:text-black focus:text-black h-10 md:text-basecursor-default flex items-center text-gray-700 outline-none";
        counterInput.setAttribute("name", item.product_id);
        counterInput.setAttribute("value", item.product_amount);
        counterInput.setAttribute("type", "number");
        counterInput.setAttribute("oninput", "validity.valid||(value='')");
        counterInput.setAttribute("min", "0");
        counterInput.addEventListener('change', change);

        const priceParagraph = document.createElement('p');
        priceParagraph.classList.add("ml-6");
        priceParagraph.innerHTML += `EGP <span class="product_cost">${item.product_amount * item.product_price}</span>`;

        const removeBtn = document.createElement('button');
        removeBtn.innerHTML = "X";
        removeBtn.addEventListener('click', remove);
        removeBtn.className = "ml-6 btn btn-info btn-sm";
        removeBtn.setAttribute("type", "button");

        counterDiv.appendChild(productLabel);
        counterDiv.appendChild(decreamentBtn);
        counterDiv.appendChild(counterInput);
        counterDiv.appendChild(increamentBtn);

        cartItemsSection.appendChild(productDiv);

        productDiv.appendChild(counterDiv);
        counterDiv.appendChild(priceParagraph);
        counterDiv.appendChild(removeBtn);
        // cartItemsSection.innerHTML += `
        // <div class="form-controls p-2 flex items-center mb-3" product=${item.product_id}>
        //                     <label class="mr-auto">${item.product_name}</label>
        //                     <div class="counter ml-6 flex">
        //                         <button type="button" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-10 w-10 rounded-l cursor-pointer outline-none">
        //                         <span class="m-auto text-2xl font-thin">−</span>
        //                         </button>
        //                         <input value=${item.product_amount} type="number" class="outline-none focus:outline-none text-center w-10 bg-gray-300 font-semibold text-md hover:text-black focus:text-black h-10 md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="0"></input>
        //                         <button type="button" data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-10 w-10 rounded-r cursor-pointer">
        //                             <span class="m-auto text-2xl font-thin">+</span>
        //                         </button>
        //                     </div>
        //                     <p class="ml-6">EGP <span class="product_cost">${item.product_amount * item.product_price}</span></p>
        //                     <button  class="ml-6 btn btn-info btn-sm">X</button>
        //                 </div>`
    })
}

function removeAllItems(){
    const cartItemsSection = document.querySelector('.cart-items');
    cartItemsSection.innerHTML = "";
}

function addItemToCart(e){
    const product_id = parseInt(e.target.getAttribute('drink-id'));
    const product_name = e.target.getAttribute('drink-name');
    const product_price = parseInt(e.target.getAttribute('drink-price'));

    const indexOfItem = cart.findIndex(item => {
        return item.product_id === product_id;
    });
    console.log(indexOfItem);
    if(indexOfItem === -1){
        cart = [...cart, {
            product_id,
            product_name,
            product_price,
            product_amount: 1
        }]
    }else{
        cart = cart.map((item, index) => {
            if(index === indexOfItem) { 
                item.product_amount = item.product_amount + 1;
            };
            return item;
        })
    }
    removeAllItems();
    populatCartItems();
}

const removeElementFromCart = (id) => {
    const indexOfItem = cart.findIndex(item => {
        return item.product_id === id;
    });
    console.log(indexOfItem);
    if(cart[indexOfItem].product_amount <= 1){
        cart = cart.filter(item => item.product_id !== id)
    }else{
        cart = cart.map((item, index) => {
            if(index === indexOfItem) { 
                item.product_amount = item.product_amount - 1;
            };
            return item;
        })
    }
    removeAllItems();
    populatCartItems();
};

function increaseItemByOne(id){
    cart = cart.map((item, index) => {
        if(item.product_id === id) { 
            item.product_amount = item.product_amount + 1;
        };
        return item;
    });

    removeAllItems();
    populatCartItems();
}

function deleteItemFromCart(id){
    cart = cart.filter(item => item.product_id !== id);
    removeAllItems();
    populatCartItems();
} 

function setCartItemValue(id, amount){
    cart = cart.map((item, index) => {
        if(item.product_id === id) { 
            item.product_amount = amount;
        };
        return item;
});
    removeAllItems();
    populatCartItems();
}

document.querySelectorAll('.drink').forEach(card => {
    card.addEventListener('click', addItemToCart)
});

function updatePrice(){
    const priceSpan = document.querySelector('.total-price');
    const totalPrice = cart.reduce((a, c) => {
        return a + c.product_amount * c.product_price;
    }, 0);
    if(totalPrice){
        priceSpan.innerHTML = totalPrice;
    }else{
        priceSpan.innerHTML = "00.00";
    }
    console.log(totalPrice);
}
populatCartItems();
