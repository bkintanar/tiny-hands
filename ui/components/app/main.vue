<template>
  <div class="h-screen flex overflow-hidden bg-gray-100">
    <static-sidebar-mobile :open="open" @toggleSidebar="toggleSidebar($event)" />
    <static-sidebar-desktop />
    <div class="flex flex-1 flex-col md:pl-64 overflow-hidden">
      <app-header @toggleSidebar="toggleSidebar($event)"/>
      <slot />
    </div>
  </div>
</template>
<script setup>
const open = ref(false)

function toggleSidebar(force) {
  if (force) {
    open.value = false
  } else {
    open.value = !open.value
  }
}
</script>
