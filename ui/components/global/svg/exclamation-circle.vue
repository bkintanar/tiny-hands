<template>
  <div
    v-show="hasError"
    class="absolute inset-y-0 right-0 flex items-center pointer-events-none"
    :class="{ 'pr-8': isSelect, 'pr-3': !isSelect }"
  >
    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
      <path
        fill-rule="evenodd"
        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
        clip-rule="evenodd"
      />
    </svg>
  </div>
</template>

<script>
export default {
  name: 'ExclamationCircle',

  props: {
    hasError: {
      type: Boolean,
      default: false,
    },
    isSelect: {
      type: Boolean,
      default: false,
    },
  },
}
</script>
