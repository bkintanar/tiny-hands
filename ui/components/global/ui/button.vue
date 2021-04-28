<template>
  <button
    :disabled="loading"
    :type="nativeType"
    :class="{
      'w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500':
        type === 'primary',
      'w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out':
        type === 'secondary',
    }"
  >
    <svg-animation-spin :loading="loading" />
    <slot />
  </button>
</template>

<script>
export default {
  name: 'Button',

  props: {
    nativeType: {
      type: String,
      default: 'submit',
    },

    type: {
      type: String,
      default: 'primary',
    },

    loading: {
      type: Boolean,
      default: false,
    },

    customClass: {
      type: String,
      default: '',
    },
  },
}
</script>
