<?php
require("./dataBase.php");
session_start();

if ($_SESSION['login']) {
    header("Location: myOrders.php");
} else {
    header("Location: sign_in.php");
}


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.13.6/dist/full.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <?php include './tempNav.html'  ?>
    <div class="m-12 ">
        <?php include './slider.html'  ?>
        <!-- Dates from to and stuff -->
        <form action="<?php $_PHP_SELF ?>" method="GET">
            <div class="grid gap-4 place-content-center my-12">
                <div class="bg-no-repeat bg-cover bg-center w-fit rounded-lg" style="background-image: url('./images/1.jpg')">
                    <div class="flex justify-center  m-12">
                        <!-- date from -->
                        <div class=" indicator p-3 mx-12">
                            <div class="indicator-item indicator-bottom">
                                <input type="date" name="from" class="input input-bordered input-primary w-full max-w-xs">
                            </div>
                            <div class="card border">
                                <div class="card-body">
                                    <div class="stack">
                                        <div class="text-center shadow-md w-36 card bg-base-200">
                                            <div class="card-body flex items-center">
                                                <p>Date From</p>
                                                <svg class="w-10 h-10 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-center shadow w-36 card bg-base-200">
                                            <div class="card-body">B</div>
                                        </div>
                                        <div class="text-center shadow-sm w-36 card bg-base-200">
                                            <div class="card-body">C</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- date to -->
                        <div class="indicator p-3 mx-12">
                            <div class="indicator-item indicator-bottom">
                                <input type="date" name="to" class="input input-bordered input-primary w-full max-w-xs">
                            </div>
                            <div class="card border">
                                <div class="card-body">
                                    <div class="stack">
                                        <div class="text-center shadow-md w-36 card bg-base-200">
                                            <div class="card-body flex items-center">
                                                <p>Date To</p>
                                                <svg class="w-10 h-10 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="text-center shadow w-36 card bg-base-200">
                                            <div class="card-body">B</div>
                                        </div>
                                        <div class="text-center shadow-sm w-36 card bg-base-200">
                                            <div class="card-body">C</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <button class="btn glass">Search</button> -->
                    </div>
                    <div class="flex justify-center">
                        <button class="btn gap-2 my-8 btn-primary" type="submit">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg> Search
                        </button>
                    </div>
                </div>
                <!-- button type submit -->
            </div>
        </form>
        <!--end of Dates from to and stuff -->
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg container mx-auto my-12 " data-accordion="collapse" id="accordion-flush">
        <table class="w-full text-sm text-gray-500 dark:text-gray-400">
            <thead class="text-2xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                <tr class="text-center">
                    <th scope="col" class="p-4">

                    </th>
                    <th scope="col" class="px-6 py-3 hover:text-sky-400">
                        Order Date
                    </th>
                    <th scope="col" class="px-6 py-3 hover:text-sky-400">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 hover:text-sky-400">
                        Order ID
                    </th>
                    <th scope="col" class="px-6 py-3 hover:text-sky-400">
                        Action
                    </th>
                </tr>
            </thead>
            <!-- Start of Dynamic Data -->
            <tbody>
                <?php
                // to add user id through sessions
                // to be added session file ("../Admin/views/sessionValidtion.php");
                $userID = $_SESSION['id']; //till now its
                $db = new Database();
                $db->connect();
                if (isset($_GET['from']) && isset($_GET['to'])) {
                    $from = $_GET['from'];
                    $to = $_GET['to'];
                    $orders = $db->selectOrdersByDate($userID, $from, $to);
                } else {
                    $orders = $db->selectUserOrdersFilteredByDate($userID);
                }
                foreach ($orders as $order) {
                ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <button class="btn btn-default btn-sm" data-accordion-target="<?php echo "#id" . $order['id'] ?>">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 text-lg text-gray-900 dark:text-white whitespace-nowrap text-center">
                            <?php
                            $date = new DateTime($order["date"]);
                            echo $date->format('g:ia \o\n l jS F Y');
                            ?>
                        </th>
                        <td class="px-6 py-4 text-lg capitalize text-center">
                            <?php echo $order["status"] ?>
                        </td>
                        <td class="px-6 py-4 text-center text-lg">
                            <?php echo $order["id"] ?>
                        </td>
                        <td class="px-6 py-4 text-center text-lg">
                            <a href="deleteOrder.php?id=<?php echo $order['id'] ?>" class="trash btn <?php if ($order['status'] != 'processing') {
                                                                                                            echo 'hidden';
                                                                                                        } ?>">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <td>
                        <div class="hidden flex justify-start md:justify-between " id="<?php echo "id" . $order['id'] ?>">
                            <?php
                            $products = $db->getProductsInOrders($order['id']);
                            $sum = [];
                            foreach ($products as $product) {
                            ?>
                                <!-- to be deleted -->
                                <div class="w-80 m-6 p-4 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                    <img class="p-8 rounded-t-lg" src="<?php echo "./images/product_image/" . $product['picture'] ?>" alt="product image">
                                    <div class="px-5 pb-5">
                                        <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white capitalize text-center "><?php echo $product['name'] ?></h5>
                                        <div class="flex justify-center my-4">
                                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <svg class="w-5 h-5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">5.0</span>
                                        </div>
                                        <div class="items-center">
                                            <h5 class="text-2xl my-1 font-bold text-gray-900 dark:text-white"><span class="mr-2 text-sky-400/75 text-2xl">Price:</span> <?php echo $product['price'] ?> EG</h5>
                                            <h5 class="text-2xl my-1 font-bold text-gray-900 dark:text-white"><span class="mr-2 text-sky-400/75 text-2xl">Amount:</span> <?php echo $product['quantity'] ?></h5>
                                            <?php $total = ($product['price']) * ($product['quantity']);
                                            array_push($sum, $total) ?>
                                            <h5 class="text-2xl my-1 font-bold text-gray-900 dark:text-white"><span class="mr-2 text-sky-400/75 text-2xl">Total Amount:</span><?php echo $total ?> EG</h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- to be deleted -->
                            <?php
                            }
                            ?>
                        </div>
                    </td>
                <?php   } ?>
            </tbody>
        </table>
    </div>
    <!-- end of dyanmic data -->


    <script src=" https://unpkg.com/flowbite@1.4.1/dist/flowbite.js">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>