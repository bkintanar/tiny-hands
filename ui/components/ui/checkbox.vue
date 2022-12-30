<template>
  <div class="flex items-center">
    <input
      :id="name"
      :name="name"
      type="checkbox"
      :checked="isChecked"
      :required="required ? 'required' : false"
      class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
    <label :for="name" class="ml-2 block text-sm text-gray-900"><slot /></label>
  </div>
</template>
<script setup>
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid'

defineProps({
  'name': {
    type: String,
    required: true,
  },
  'modelValue': {
    type: String,
    required: true,
  },
  'required': {
    type: Boolean,
    default: false
  },
  'isChecked': {
    type: Boolean,
    default: false,
  }
})

defineEmits(['update:modelValue'])
</script>
