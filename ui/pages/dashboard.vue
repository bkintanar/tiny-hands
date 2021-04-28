<template>
  <ui-main>
    <main class="h-screen flex overflow-hidden focus:outline-none bg-white">
      <div class="flex flex-col min-w-0 flex-1 overflow-hidden">
        <breadcrumb />
        <div
          class="px-6 pt-6 pb-4 border-b border-gray-200 flex items-center justify-between"
        >
          <h2 class="text-xl pb-2.5 leading-6 font-bold text-gray-900">
            {{ $t('dashboard') }}
          </h2>
        </div>
      </div>
    </main>
  </ui-main>
</template>
<script>
export default {
  layout: 'default',
  middleware: 'verified',
  head() {
    return { title: this.$t('dashboard') }
  },
}
</script>
