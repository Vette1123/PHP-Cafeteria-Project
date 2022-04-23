<?php 
    include('./DataBase.php');
    $userId = 3;
    $latestOrderProducts = [];
    
    $DB = new DataBase();
    $DB->connect();
    getLastOrder();
    

    if(isset($_POST['search'])){
        $allProducts = $DB->searchProducts($_POST["search"]);
    }else{
        $allProducts = $DB->selectAllByTableName('products');
    }


    if(isset($_POST['cart'])){
        $allProductsId = $DB->getAllTableIDs('products');
        $orderProducts = array_intersect_key( $_POST , array_flip( $allProductsId ) );
        if(!empty($orderProducts)){
        $totalPrice = 0;
        foreach ($orderProducts as $key => $value) {
            $totalPrice += (float)$DB->getProductPrice($key)[0] * (int)$value;
        }
        $orderId = $DB->placeOrder($userId, $totalPrice);
        $DB->placeOrderDetails($orderId, $orderProducts);
        getLastOrder();
    }
    }

    function getLastOrder(){
        global $DB;
        global $userId;
        global $latestOrderProducts;
        $lastOrderId = $DB->getLastOrderId($userId);
        if($lastOrderId){
            $latestOrderProducts = $DB->getProductsInOrders($lastOrderId);
        }
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
                            <form action="" method="POST">
                                <input name="search" type="sumbit" type="text" id="product-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for products">
                            </form>
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
                    <button class='self-end cursor-pointer w-32 text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-4' type="sumbit" value="confirm" name="cart">Confirm</button>
                </form>
            </div>
            <!-- Drinks Sections Starts -->
            <div class="lg:col-span-2 col-start-1 drinks lg:col-start-2">
            <?php 
                        if(count($latestOrderProducts) !== 0){
                           echo" <h2 class='text-4xl sm:text-left text-center  font-bold my-6'>Latest Order</h2>
                            <section class='latest grid sm:grid-cols-3 grid-cols-1 gap-4 mt-4 mb-6'>";
                            foreach ($latestOrderProducts as $product) { 
                                echo   "<div class='drink card w-100 border h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4' drink-id={$product['id']} drink-name={$product['name']} drink-price={$product['price']}>
                                       <img src='http://localhost/php_project/images/product_image/{$product['picture']}' class='w-full h-80 card-image' />
                                       <div class='flex justify-between items-center mt-4'>
                                       <h3 class='text-2xl'>{$product['name']}</h3>
                                       <p class='text-2xl'>{$product['price']} EGP</p>
                                       </div>
                                       <p class='text-2xl mt-4'>X {$product['quantity']}</p>
                                   </div>";
                               }
                            echo "</section>";
                            echo "<hr>";
                        }
                    ?>
                <h2 class="text-4xl text-center sm:text-left font-bold my-6">Products</h2>
                <section class="drinks grid sm:grid-cols-3 grid-cols-1 gap-4 mt-6 mb-6" id="drinks">
                    <?php 
                    if(count($allProducts) === 0){
                        echo "<p class='text-center text-4xl font-bold my-6'>No Products Found</p>";
                    }else{
                    foreach ($allProducts as $product) { 
                     echo   "<div class='drink card w-100 border h-100 shadow-ms rounded hover:shadow-lg p-4 mb-4' drink-id={$product['id']} drink-name={$product['name']} drink-price={$product['price']}>
                            <img src='http://localhost/php_project/images/product_image/{$product['picture']}' class='w-full h-80 card-image' />
                            <div class='flex justify-between items-center mt-4'>
                            <h3 class='text-2xl'>{$product['name']}</h3>
                            <p class='text-2xl'>{$product['price']} EGP</p>
                            </div>
                        </div>";
                    }
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
