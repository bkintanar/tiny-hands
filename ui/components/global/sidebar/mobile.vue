<template>
  <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
  <div :class="{ '': showElement, hidden: !showElement }" class="md:hidden">
    <div
      class="fixed inset-0 flex z-40"
      tabindex="0"
      @keydown.esc="toggleSidebar(true)"
    >
      <transition
        enter-active-class="transition-opacity ease-linear duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity ease-linear duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div v-show="open" class="fixed inset-0" @click="toggleSidebar(true)">
          <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
        </div>
      </transition>
      <transition
        enter-active-class="transition ease-in-out duration-300 transform"
        enter-class="-translate-x-full"
        enter-to-class="translate-x-0"
        leave-active-class="transition ease-in-out duration-300 transform"
        leave-class="translate-x-0"
        leave-to-class="-translate-x-full"
        @before-enter="beforeToggleSidebar()"
        @after-leave="afterToggleSidebar()"
      >
        <div
          v-show="open"
          class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-800"
        >
          <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button
              class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
              @click="toggleSidebar()"
            >
              <span class="sr-only">{{ $t('close_sidebar') }}</span>
              <!-- Heroicon name: outline/x -->
              <svg
                class="h-6 w-6 text-white"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
          <div class="flex-shrink-0 flex items-center px-4">
            <img
              class="h-8 w-auto"
              src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
              alt="Workflow"
            />
          </div>
          <div class="mt-5 flex-1 h-0 overflow-y-auto">
            <nav class="px-2 space-y-1">
              <nuxt-link
                :to="{ name: 'dashboard.index' }"
                :class="{
                  'bg-gray-900 text-white':
                    $nuxt.$route.name === 'dashboard.index',
                  'text-gray-300 hover:bg-gray-700 hover:text-white':
                    $nuxt.$route.name !== 'dashboard.index',
                }"
                class="group flex items-center px-2 py-2 text-base font-medium rounded-md"
              >
                <!-- Heroicon name: outline/home -->
                <svg
                  :class="{
                    'text-gray-300': $nuxt.$route.name === 'dashboard.index',
                    'text-gray-400 group-hover:text-gray-300':
                      $nuxt.$route.name !== 'dashboard.index',
                  }"
                  class="mr-4 h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  />
                </svg>
                {{ $t('dashboard') }}
              </nuxt-link>

              <a
                href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
              >
                <!-- Heroicon name: outline/folder -->
                <svg
                  class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                  />
                </svg>
                Projects
              </a>

              <a
                href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
              >
                <!-- Heroicon name: outline/calendar -->
                <svg
                  class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                  />
                </svg>
                Calendar
              </a>

              <a
                href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
              >
                <!-- Heroicon name: outline/inbox -->
                <svg
                  class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
                  />
                </svg>
                Documents
              </a>

              <a
                href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"
              >
                <!-- Heroicon name: outline/chart-bar -->
                <svg
                  class="text-gray-400 group-hover:text-gray-300 mr-4 h-6 w-6"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  aria-hidden="true"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
                  />
                </svg>
                Reports
              </a>
            </nav>
          </div>
          <div class="flex-shrink-0 flex pl-4 pr-4">
            <ui-language-dropdown />
          </div>
        </div>
      </transition>
      <div class="flex-shrink-0 w-14" aria-hidden="true">
        <!-- Dummy element to force sidebar to shrink to fit close icon -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Mobile',
  props: {
    open: Boolean,
  },
  data: () => ({
    showElement: false,
  }),
  methods: {
    routeIs(route) {
      return this.$route.name.includes(route)
    },
    toggleSidebar(force) {
      this.$emit('toggleSidebar', force)
    },
    beforeToggleSidebar() {
      this.showElement = true
    },
    afterToggleSidebar() {
      this.showElement = false
    },
  },
}
</script>
