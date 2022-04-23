<?php

 function usersNav($name,$profile_pic){
  
echo "
<div class='navbar bg-slate-800 text-neutral-content'>
  <div class='container mx-auto'>
    <a class='btn btn-ghost normal-case text-xl' href='myOrders.php'>
      Cafetria
    </a>

    <ul
      class='flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium'
    >
      <li>
        <a
          href='#'
          class='block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700'
        >
          Home
        </a>
      </li>
      <li>
        <a
          href='#'
          class='block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700'
        >
          My Order
        </a>
      </li>
    </ul>
  </div>

  <div class='flex-none gap-2'></div>
  <div class='dropdown dropdown-end'>
    <label tabindex='0' class='btn btn-ghost btn-circle avatar'>
      <div class='w-10 rounded-full'>
        <img src='https://api.lorem.space/image/face?hash=33791' />
      </div>
    </label>
    <ul
      tabindex='0'
      style='background-color: rgba(13, 33, 41, 0.918)'
      class='mt-3 p-2 shadow menu menu-compact dropdown-content bg-slate-900 rounded-box w-52'
    >
      <li>
        <a
          href='#'
          class='block py-2 px-4 hover:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-dark'
        >
          <b>{$name}</b>
        </a>
      </li>
      <li>
        <a
          href='#'
          class='block py-2 px-4 hover:bg-gray-700 dark:hover:bg-gray-600 dark:hover:text-dark'
          >LogOut</a
        >
      </li>
    </ul>
  </div>
</div>

"
;

}
