<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-white dark:bg-gray-900">
  <header class="absolute inset-x-0 top-0 z-50">
    <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
      <!-- Logo -->
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Best Blog</span>
          <img src="/Blog-/img/logo.png" alt="Best Blog" class="logo h-8 w-auto" />
        </a>
      </div>

      <!-- Mobile menu button -->
      <div class="flex lg:hidden">
        <button
          type="button"
          command="show-modal"
          commandfor="mobile-menu"
          class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 dark:text-gray-300"
        >
          <span class="sr-only">Open main menu</span>
          <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="1.5"
            aria-hidden="true"
            class="size-6"
          >
            <path
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </button>
      </div>

      <!-- Desktop menu -->
      <div class="hidden lg:flex lg:gap-x-12">
        <a href="/Blog-/index.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Home Page</a>
        <a href="/Blog-/customer/blog.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Blog</a>
        <a href="/Blog-/customer/aboutUs.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">About Us</a>
        <a href="/Blog-/customer/contact.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Contact</a>
      
      </div>

      <!-- Desktop login -->
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="/Blog-/login.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">
          Log in <span aria-hidden="true">&rarr;</span>
        </a>
      </div>
    </nav>

    <!-- Mobile menu -->
    <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
      <div tabindex="0" class="fixed inset-0 focus:outline-none">
        <div
          class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white dark:bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 dark:sm:ring-white/10"
        >
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img
              src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
              alt="Logo"
              class="h-8 w-auto"
            />
          </a>
          <button
            type="button"
            command="close"
            commandfor="mobile-menu"
            class="-m-2.5 rounded-md p-2.5 text-gray-700 dark:text-gray-300"
          >
            <span class="sr-only">Close menu</span>
            <svg
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              aria-hidden="true"
              class="size-6"
            >
              <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>

        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10 dark:divide-gray-700">
            <div class="space-y-2 py-6">
              <a href="/Blog-/index.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Home Page</a>
              <a href="/Blog-/customer/blog.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Blog</a>
              <a href="/Blog-/customer/aboutUs.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">About Us</a>
              <a href="/Blog-/customer/contact.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Contact</a>
            </div>
            <div class="py-6">
              <a
                href="/Blog-/login.php"
                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50 dark:text-white dark:hover:bg-gray-800"
              >
                Log in
              </a>
            </div>
          </div>
        </div>
      </div>
    </dialog>
  </header>
</div>
