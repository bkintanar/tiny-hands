<template>
  <!-- Profile dropdown -->
  <div v-click-outside="hideMenu" class="ml-3 relative" @keydown.esc="hideMenu">
    <div>
      <button
        id="user-menu"
        type="button"
        class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        aria-expanded="false"
        aria-haspopup="true"
        @click="toggleMenu()"
      >
        <span class="sr-only">{{ $t('open_user_menu') }}</span>
        <img
          class="h-8 w-8 rounded-full"
          src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=5G0gU1jGpX&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
          alt=""
        />
      </button>
    </div>

    <transition
      enter-active-class="transition ease-out duration-100"
      enter-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <div
        v-if="open"
        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="user-menu"
      >
        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
        >
          {{ $t('your_profile') }}
        </a>

        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
        >
          {{ $t('settings') }}
        </a>

        <a
          href="#"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          role="menuitem"
          @click.prevent="logout()"
        >
          {{ $t('logout') }}
        </a>
      </div>
    </transition>
  </div>
</template>
<script>
import ClickOutside from 'vue-click-outside'

export default {
  name: 'Menu',
  directives: {
    ClickOutside,
  },
  data: () => ({
    open: false,
  }),
  watch: {
    $route() {
      this.hideMenu()
    },
  },
  methods: {
    toggleMenu() {
      this.open = !this.open
    },
    hideMenu() {
      this.open = false
    },
    async logout() {
      this.hideMenu()

      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to index.
      this.$router.push({ name: 'index' })
    },
  },
}
</script>
