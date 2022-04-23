<?php

function usersNav($name,$profile_pic){

echo "
<nav class='navbar navbar-expand-lg navbar-dark bg-gray-800'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='#'>Cafetria</a>
    <button
      class='navbar-toggler'
      type='button'
      data-bs-toggle='collapse'
      data-bs-target='#navbarSupportedContent'
      aria-controls='navbarSupportedContent'
      aria-expanded='false'
      aria-label='Toggle navigation'
    >
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
        <li class='nav-item'>
          <a class='nav-link active' aria-current='page' href='#'>Home</a>
        </li>
        <li class='nav-item'>
          <a class='nav-link' href='#'>My Orders</a>
        </li>
      </ul>
      <div class='d-flex justify-between'>
        <b class='text-white my-2 text-xxl'>{$name}</b>

        <div class='flex items-center mx-5'>
          <button
            type='button'
            class='flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600'
            id='user-menu-button'
            aria-expanded='false'
            data-dropdown-toggle='dropdown'
          >
            <img
              class='w-8 h-8 rounded-full'
              src='{$profile_pic}'
              alt='user photo'
            />
          </button>
        </div>
        <a href='#' class='btn btn-dark text-white'>Logout</a>
      </div>
    </div>
  </div>
</nav>";

}



