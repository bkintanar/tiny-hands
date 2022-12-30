<template>
  <button
    :disabled="loading"
    :type="nativeType"
    :class="
    {
      'border-transparent bg-indigo-600 shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2':
      type === 'primary' && !loading,
      'shadow-sm bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed':
      type === 'primary' && loading,
      'text-white': type === 'primary',
      'border-gray-300 bg-white text-gray-500 hover:text-gray-400 focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out':
      type === 'secondary',
      'focus:outline-none': !loading
    }"
    class="border flex w-full justify-center rounded-md leading-5 py-2 px-4 text-sm font-medium"
  >
    <svg-animation-spin :loading="loading" />
    <slot v-if="!loading"/>
    {{ loading && loadingText ? loadingText + `&hellip;`: '' }}
  </button>
</template>
<script setup>
defineProps({
  'loading': {
    type: Boolean,
    default: false,
  },
  'loadingText': {
    type: String,
    default: '',
  },
  nativeType: {
    type: String,
    default: 'submit',
  },
  'type': {
    type: String,
    default: 'primary',
  }
})
</script>
