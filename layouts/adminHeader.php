<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-white dark:bg-gray-900">
  <header class="absolute inset-x-0 top-0 z-50 shadow">
    <nav aria-label="Admin Navigation" class="flex items-center justify-between p-6 lg:px-8">
      <!-- Logo -->
      <div class="flex lg:flex-1">
        <a href="/Blog-/admin/index.php" class="-m-1.5 p-1.5 flex items-center gap-2">
          <img src="/Blog-/img/logo.png" alt="Admin Dashboard" class="h-8 w-auto" />
          <span class="text-lg font-bold text-gray-900 dark:text-white">Admin Panel</span>
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
          <span class="sr-only">Open admin menu</span>
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

     
      <div class="hidden lg:flex lg:gap-x-10">
        <a href="/Blog-/admin/index.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Dashboard</a>
        <a href="/Blog-/blog/blog.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Blog</a>
        <a href="/Blog-/admin/contact.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Contacts</a>
        <a href="/Blog-/admin/dataImport.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Data Import</a>
        <a href="/Blog-/admin/bakup.php" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Backup</a>
      </div>

      
      <div class="hidden lg:flex lg:flex-1 lg:justify-end items-center gap-4">
       
        <button class="text-gray-700 dark:text-gray-300 hover:text-indigo-500">
          <span class="sr-only">View notifications</span>
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 00-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
          </svg>
        </button>

       
        <div class="relative">
          <button
            type="button"
            class="flex items-center gap-2 rounded-full text-sm focus:outline-none"
          >
            <img
              class="h-8 w-8 rounded-full border border-gray-300 dark:border-gray-600"
              src="https://ui-avatars.com/api/?name=Admin"
              alt="Admin"
            />
            <span class="hidden text-gray-900 dark:text-white lg:inline">Admin</span>
          </button>
        </div>
      </div>
    </nav>

    <!-- Mobile menu -->
    <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
      <div tabindex="0" class="fixed inset-0 focus:outline-none">
        <div
          class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white dark:bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 dark:sm:ring-white/10"
        >
          <div class="flex items-center justify-between">
            <a href="/Blog-/admin/index.php" class="-m-1.5 p-1.5 flex items-center gap-2">
              <img src="/Blog-/img/logo.png" alt="Admin Dashboard" class="h-8 w-auto" />
              <span class="font-bold text-gray-900 dark:text-white">Admin Panel</span>
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
                <a href="/Blog-/admin/index.php" class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white">Dashboard</a>
                <a href="/Blog-/blog/blog.php" class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white">Blog</a>
                <a href="/Blog-/admin/contact.php" class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white">Contacts</a>
                <a href="/Blog-/admin/dataImport.php" class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white">Data Import</a>
                <a href="/Blog-/admin/bakup.php" class="block text-sm font-semibold leading-6 text-gray-900 dark:text-white">Backup</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </dialog>
  </header>
</div>
