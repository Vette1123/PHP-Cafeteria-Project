<div class="hidden flex justify-start md:justify-between collapse " id="<?php echo "ideksde" . $user['id'] ?>">
                            <table class="w-full text-sm text-gray-500 dark:text-gray-400">
                                <thead class="text-2xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                                    <tr class="text-center">
                                        <th scope="col" class="px-6 py-3 hover:text-sky-400">
                                            Product Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 hover:text-sky-400">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 hover:text-sky-400">
                                            Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['from']) && isset($_GET['to'])) {
                                        $orders = $db->selectOrdersByDate($user['id'], $from, $to);
                                    } else {
                                        $orders = $db->selectUserOrders($user['id']);
                                    }
                                    foreach ($orders as $order) {
                                    ?>
                                        <!-- insert of row -->

                                        <tr class="bg-white border-b dark:bg-gray-600 dark:border-gray-500 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td scope="row" class="px-6 py-4 text-lg text-gray-900 dark:text-white whitespace-nowrap text-center">
                                                <div class="items-center">
                                                    <button class="btn btn-default btn-lg items-center" data-accordion-target="<?php echo "#idwewe" . $order['id'] ?>">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <th scope="row" class="px-6 py-4 text-lg text-gray-900 dark:text-white whitespace-nowrap text-center">
                                                <?php echo $order["date"] ?>
                                            </th>
                                            <td class="px-6 py-4 text-lg capitalize text-center">
                                                <?php echo $order["totalPrice"] ?>
                                            </td>
                                        </tr>

                                        <!-- to be deleted -->
                                        <!-- collapsaple -->
                                        <tr>
                                            <td>
                                                <div class="hidden flex justify-start md:justify-between " id="<?php echo "idwewe" . $order['id'] ?>">
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
                                        </tr>
                                    <?php } ?>
                                    <!-- end of collapsaple -->
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
        </div>
        <!-- end of user items -->
        <!-- start of orders -->
    </div>
