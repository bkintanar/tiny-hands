<template>
  <!-- Profile dropdown -->
  <Menu v-slot="{ open }" as="div" class="relative ml-3" @keydown.esc="hideMenu">
    <div>
      <MenuButton @click="toggleMenu()" class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        <span class="sr-only">Open user menu</span>
        <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
      </MenuButton>
    </div>
    <transition v-show="open" enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
      <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
        <MenuItem v-slot="{ active }" disabled>
          <a href="#" :class="[active ? 'bg-gray-100' : '', 'opacity-75 block px-4 py-2 text-sm text-gray-700']">{{ 'Your Profile' }}</a>
        </MenuItem>
        <MenuItem v-slot="{ active }" disabled>
          <a href="#" :class="[active ? 'bg-gray-100' : '', 'opacity-75 block px-4 py-2 text-sm text-gray-700']">{{ 'Settings' }}</a>
        </MenuItem>
        <MenuItem v-slot="{ active }">
          <a href="#" @click.prevent="logout" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ t('logout') }}</a>
        </MenuItem>
      </MenuItems>
    </transition>
  </Menu>
</template>
<script setup>
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {useAuthStore} from "~/store/auth";
import {notify} from "@kyvg/vue3-notification";

const { t } = useI18n()

const open = ref(false)

function hideMenu() {
  open.value = false
}

function toggleMenu() {
  open.value = !open.value
}

async function logout() {
  const authStore = useAuthStore()
  await authStore.logout()

  notify({
    title: t('logout_successful'),
    text: t('you_have_been_logged_out'),
    type: 'success',
    duration: 5000,
  })

  return navigateTo({name: 'login'})
}
</script>
