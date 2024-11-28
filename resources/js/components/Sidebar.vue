<template>
    <div :class="{'w-64': isSidebarOpen, 'w-20': !isSidebarOpen}"
         class="transition-all duration-300 bg-gray-800 text-white shadow-md flex flex-col p-3 h-full">
      <div class="space-y-3">
        <!-- Bagian Header Sidebar -->
        <div class="flex items-center justify-between">
          <h2 v-if="isSidebarOpen" class="text-xl font-bold">Dashboard</h2>
          <button @click="toggleSidebar" class="lg:hidden text-2xl text-white">
            <i class="bi bi-filter-left"></i>
          </button>
        </div>

        <!-- Menu Sidebar -->
        <div class="flex-1 mt-4">
          <ul class="space-y-2 text-sm">
            <li class="rounded-sm">
              <a href="/" class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span v-if="isSidebarOpen">Home</span>
              </a>
            </li>
            <li class="rounded-sm">
                <router-link to="/form-pelajar" class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                </svg>
                <span v-if="isSidebarOpen">Tambah Pelajar</span>
                </router-link>
            </li>
            <li class="rounded-sm">
              <!-- <a href="#" class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                </svg>
                <span v-if="isSidebarOpen">Orders</span>
              </a> -->
            </li>
            <li class="rounded-sm">
              <!-- <a href="#" class="flex items-center p-2 space-x-3 rounded-md hover:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                </svg>
                <span v-if="isSidebarOpen">Settings</span>
              </a> -->
            </li>
          </ul>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      isSidebarOpen: {
        type: Boolean,
        default: true
      }
    },
    methods: {
      toggleSidebar() {
        this.$emit('toggle-sidebar');
      }
    }
  };
  </script>
