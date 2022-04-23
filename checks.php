<?php
require("./dataBase.php");
session_start();

if ($_SESSION['role'] === 'admin') {
    header("Location: checks.php");
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
    <title>Admin Checks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.13.6/dist/full.css" rel="stylesheet" type="text/css" />
    <!-- <style>
        .custom {
            background-color: #fafafa !important;
            border: 1px solid #e0e0e0 !important;
            border-radius: 5px !important;
            padding: 10px !important;
            margin: 1rem !important;
            width: 80rem !important;
        }
    </style> -->
</head>

<body>
    <?php include './tempNav.html'  ?>
    <div class="m-12 container mx-auto">
        <h1 class="text-2xl">Checks</h1>
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
            </div>
        </form>
        <!--end of Dates from to and stuff -->
        <!-- start of user -->
        <form action="<?php $_PHP_SELF ?>" method="GET">
            <div class="grid place-content-center">
                <div>
                    <label for="countries" class="text-center block mb-6 text-2xl font-medium text-gray-900 dark:text-gray-400">Filter By Username</label>
                    <select id="countries" name="selectedUser" class="w-96 text-2xl capitalize  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" disabled selected>Select Username</option>
                        <?php
                        $db = new DataBase();
                        $db->connect();
                        $users = $db->selectAllUsers("users");
                        foreach ($users as $user) {
                            echo '<option value="' . $user['id'] . '">' . $user['name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="text-center">
                    <button class="btn gap-2 my-8 btn-primary" type="submit">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg> Search
                    </button>
                </div>
            </div>
        </form>
        <!-- table  -->
        <div class="shadow-md sm:rounded-lg my-12">
            <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                <thead class="text-2xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3 hover:text-sky-400">
                            User Orders
                        </th>
                        <th scope="col" class="px-6 py-3 hover:text-sky-400">
                            User's Name
                        </th>
                        <th scope="col" class="px-6 py-3 hover:text-sky-400">
                            Total Price
                        </th>
                    </tr>
                </thead>
                <!-- Start of Dynamic Data -->
                <tbody>
                    <?php
                    // to add user id through sessions
                    // to be added session file ("../Admin/views/sessionValidtion.php");
                    $db = new Database();
                    $db->connect();
                    if (isset($_GET['from']) && isset($_GET['to'])) {
                        $from = $_GET['from'];
                        $to = $_GET['to'];
                        $users = $db->selectUsersWithDate($from, $to);
                    } elseif (isset($_GET['selectedUser'])) {
                        $selected = $_GET['selectedUser'];
                        $users = $db->selectUserOrdersByid($selected);
                    } else {
                        $users = $db->showUsers();
                    }
                    ?>
                    <?php
                    foreach ($users as $user) {
                    ?>
                        <!-- <div class="text-center"> -->
                        <tr class="table-auto bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-max p-4 text-center">
                                <div class="items-center">
                                    <button class="btn btn-default btn-lg items-center" data-bs-toggle="collapse" data-bs-target="<?php echo "#ideksde" . $user['id'] ?>" aria-expanded="true" aria-controls="<?php echo "#ideksde" . $user['id'] ?>">
                                        <svg class=" w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <th class="px-6 py-4 text-2xl text-gray-900 dark:text-white whitespace-nowrap text-center capitalize ">
                                <?php echo $user["name"] ?>
                            </th>
                            <td class="px-6 py-4 text-2xl capitalize text-center capitalize ">
                                <?php echo $user["totalPrice"] ?>
                            </td>
                        </tr>
                        <!-- </div> -->
                        <!-- end for users -->
                        <tr class="collapse flex justify-center m-12" id="<?php echo "ideksde" . $user['id'] ?>">
                            <td class="w-0"></td>
                            <td class="w-0"></td>
                            <td class="grid place-content-center">
                                <table class="mx-12 text-gray-500 dark:text-gray-400">
                                    <thead class="text-2xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr class="text-center table-auto">
                                            <th class="px-6 py-3 hover:text-sky-400">
                                                Toggle Product
                                            </th>
                                            <th class="px-6 py-3 hover:text-sky-400">
                                                Date
                                            </th>
                                            <th class="px-6 py-3 hover:text-sky-400">
                                                Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- start of orders -->
                                    <tbody>
                                        <?php
                                        if (isset($_GET['from']) && isset($_GET['to'])) {
                                            $orders = $db->selectOrdersByDate($user['id'], $from, $to);
                                        } else {
                                            $orders = $db->selectUserOrdersFilteredByDate($user['id']);
                                        }
                                        foreach ($orders as $order) {
                                        ?>
                                            <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td>
                                                    <button class="btn btn-default btn-lg items-center" data-bs-toggle="collapse" data-bs-target="<?php echo "#cont2" . $order['id'] ?>" aria-expanded="true" aria-controls="<?php echo "#cont2" . $order['id'] ?>">
                                                        <svg class=" w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                    </button>
                                                </td>
                                                <td class="px-8 py-8 text-lg text-gray-900 dark:text-white whitespace-nowrap text-center"><?php
                                                                                                                                            $date = new DateTime($order["date"]);
                                                                                                                                            echo $date->format('g:ia \o\n l jS F Y'); ?></td>
                                                <td class="px-8 py-8 text-center text-xl"><?php echo $order["totalPrice"] ?></td>
                                            </tr>
                                            <tr class="collapse" id="<?php echo "cont2" . $order['id'] ?>">
                                                <td>
                                                    <div class="flex">

                                                        <?php
                                                        $products = $db->getProductsInOrders($order['id']);
                                                        // prodcuts
                                                        foreach ($products as $product) {
                                                        ?>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>

            </table>
        </div>
        <!-- end of table -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
    <script src=" https://unpkg.com/flowbite@1.4.1/dist/flowbite.js">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>