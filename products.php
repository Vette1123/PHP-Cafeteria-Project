<?php 
    include('./DataBase.php');

    $DB = new DataBase();
    $DB->connect();
    $allProducts = $DB->selectAllByTableName('products');

    $userId = 2;

    if(isset($_POST['sumbit'])){
        $allProductsId = $DB->getAllTableIDs('products');
        $orderProducts = array_intersect_key( $_POST , array_flip( $allProductsId ) );
        if(empty($orderProducts)) exit;
        $totalPrice = 0;
        foreach ($orderProducts as $key => $value) {
            $totalPrice += (float)$DB->getProductPrice($key)[0] * (int)$value;
        }
        $orderId = $DB->placeOrder($userId, $totalPrice);
        $DB->placeOrderDetails($orderId, $orderProducts);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.2/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Products</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
         input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
  }

        .custom-number-input input:focus {
            outline: none !important;
        }

        .custom-number-input button:focus {
            outline: none !important;
        }

        .form-controls:not(:last-of-type){
            margin-bottom: 2rem;
        }

        .drink{
            cursor: pointer;
        }

        .drink > *{
            pointer-events: none;
        }

        button > *{
            pointer-events: none;

        }


        /* .drinks{
            grid-column-start: 2 !important;
        } */
    </style>
</head>
<body >
    <section class="products flex-col min-h-screen flex">
        <div class="container mx-auto">
            <!-- Search Section -->
            <div class="flex ">
                <div class="p-4 mx-auto md:ml-auto md:mr-0 ">
                        <label for="product-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                            </div>
                            <input type="text" id="product-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for meals">
                        </div>
                </div>
            </div>
        <!-- Search Section Ends -->

        <!-- Main Section Starts -->
        <div class="grid lg:grid-cols-3 grid-col-1 gap-4">
            <!-- Cart Section starts here -->
            <div class="flex mt-28 flex-col p-4 rounded shadow-lg border self-start cart lg:sticky top-10">
                <h2 class="text-center text-6xl mb-9">Cart</h2>
                <form action="" method="POST" >
                    <div class="cart-items">
                        <!-- <div class="form-controls p-2 flex items-center mb-3" product="1">
                            <label class="mr-auto">product</label>
                            <div class="counter ml-6 flex">
                                <button type="button" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-10 w-10 rounded-l cursor-pointer outline-none">
                                <span class="m-auto text-2xl font-thin">−</span>
                                </button>
                                <input value="1" type="number" class="outline-none focus:outline-none text-center w-10 bg-gray-300 font-semibold text-md hover:text-black focus:text-black h-10 md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="0"></input>
                                <button type="button" data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-10 w-10 rounded-r cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                            <p class="ml-6">EGP <span class="product_cost">25</span></p>
                            <button data-action="remove" class="ml-6 btn btn-info btn-sm">X</button>
                        </div> -->
                    </div>
                    <div class="form-controls mt-4">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your notes</label>
                        <textarea id="notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white " placeholder="Leave your notes here" name="notes"></textarea>
                    </div>

                    <div class="form-controls mt-4 mb-10">
                        <label for="rooms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select your room</label>
                        <select value="<?php if(isset($olddata->country)) {echo $olddata->country;} ?>" name="room" id="rooms" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        <option value="2003"  >2003</option>
                        <option value="2004" >2004</option>
                        <option value="2005" >2005</option>
                        <option value="2006" >2006</option>
                        </select>
                    </div>
                    <hr>
                    <div class="flex items-center justify-between my-6" >
                    <p class="text-2xl">Total Price: </p>
                    <h2 class="text-4xl"><span class="total-price">55</span> EGP</h2>
                    </div>
                    <button class='self-end cursor-pointer w-32 text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4' type="sumbit" value="confirm" name="sumbit">Confirm</button>
                </form>
            </div>
            <!-- Drinks Sections Starts -->
            <div class="lg:col-span-2 col-start-1 drinks lg:col-start-2">
                <h2 class="text-4xl sm:text-left text-center  font-bold my-6">Latest Order</h2>
                <section class="latest grid sm:grid-cols-3 grid-cols-1 gap-4 mt-4 mb-6">
                    <div class="drink card w-100 bordered h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4" drink-id="1" drink-name="tea" drink-price="5">
                        <img src="https://via.placeholder.com/300.png/09f/fff" class="w-full  card-image" />
                        <div class="flex justify-between items-center mt-4">
                        <h3 class="text-2xl">Tea</h3>
                        <p class="text-2xl">5.00 EGP</p>
                        </div>
                    </div>
                    <div class="drink card w-100 bordered h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4" drink-id="2" drink-name="coffee" drink-price="10">
                        <img src="https://via.placeholder.com/300.png/09f/fff" class="w-full  card-image" />
                        <div class="flex justify-between items-center mt-4">
                        <h3 class="text-2xl">Tea</h3>
                        <p class="text-2xl">5.00</p>
                        </div>
                    </div>
                    <div class="drink card w-100 bordered h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4" drink-id="3" drink-name="ice-cream" drink-price="15">
                        <img src="https://via.placeholder.com/300.png/09f/fff" class="w-full  card-image" />
                        <div class="flex justify-between items-center mt-4">
                        <h3 class="text-2xl">Tea</h3>
                        <p class="text-2xl">5.00</p>
                        </div>
                    </div>
                    <div class="drink card w-100 bordered h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4" drink-id="4" drink-name="coca-cola" drink-price="20">
                        <img src="https://via.placeholder.com/300.png/09f/fff" class="w-full  card-image" />
                        <div class="flex justify-between items-center mt-4">
                        <h3 class="text-2xl">Tea</h3>
                        <p class="text-2xl">5.00</p>
                        </div>
                    </div>
                </section>
                <hr>
                <h2 class="text-4xl text-center sm:text-left font-bold my-6">Drinks</h2>
                <section class="drinks grid sm:grid-cols-3 grid-cols-1 gap-4 mt-6 mb-6" >
                    <?php 
                    foreach ($allProducts as $product) { 
                     echo   "<div class='drink card w-100 border h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4' drink-id={$product['id']} drink-name={$product['name']} drink-price={$product['price']}>
                            <img src='http://localhost/php_project/images/product_image/{$product['picture']}' class='w-full h-80 card-image' />
                            <div class='flex justify-between items-center mt-4'>
                            <h3 class='text-2xl'>{$product['name']}</h3>
                            <p class='text-2xl'>{$product['price']} EGP</p>
                            </div>
                        </div>";
                    }
                    ?>
                </section>
            </div>
        </div>
        </div>

        <footer class="footer bg-black p-4 mt-auto">Hello World fake footer</footer>
        
    </section>

    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>
    <script src="./counter.js"></script>
    <script src="./products.js"></script>
</body>
</html>