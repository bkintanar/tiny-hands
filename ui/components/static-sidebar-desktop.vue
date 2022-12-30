<template>
  <!-- Static sidebar for desktop -->
  <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
    <!-- Sidebar component, swap this element with another sidebar if you like -->
    <div class="flex flex-grow flex-col overflow-y-auto border-r border-gray-200 bg-white pt-5">
      <div class="flex flex-shrink-0 items-center px-4">
        <img class="h-8 w-auto" src="/logo.png" alt="Your Company" />
      </div>
      <div class="mt-5 flex flex-grow flex-col">
        <nav class="flex-1 space-y-1 px-2 pb-4">
          <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']">
            <component :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
            {{ item.name }}
          </a>
        </nav>

        <div class="flex-shrink-0 flex p-4">
          <ui-language-dropdown />
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import {CalendarIcon, ChartBarIcon, FolderIcon, AcademicCapIcon, InboxIcon, UsersIcon} from "@heroicons/vue/24/outline";

const navigation = [
  { name: 'Dashboard', href: '#', icon: AcademicCapIcon, current: true },
  { name: 'Team', href: '#', icon: UsersIcon, current: false },
  { name: 'Projects', href: '#', icon: FolderIcon, current: false },
  { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
  { name: 'Documents', href: '#', icon: InboxIcon, current: false },
  { name: 'Reports', href: '#', icon: ChartBarIcon, current: false },
]
</script>
