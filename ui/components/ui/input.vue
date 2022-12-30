<template>
  <div>
    <label :for="name" class="block text-sm font-medium text-gray-700">
      <slot />
    </label>
    <div class="relative mt-1 rounded-md shadow-sm">
      <input
          :id="name"
          :name="name"
          :value="modelValue"
          :type="type"
          :disabled="disabled ?? false"
          class="block w-full rounded-md focus:outline-none sm:text-sm"
          :class="{
            'border-red-300 pr-10 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500': errors.has(name) || (errorKey && errors.has(errorKey)),
            'appearance-none border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500': !errors.has(name) && !(errorKey && errors.has(errorKey)),
            'disabled:cursor-not-allowed disabled:border-gray-200 disabled:bg-gray-50 disabled:text-gray-500': disabled
          }"
          :autocomplete="name === 'password' ? 'current-password': name"
          :required="required ? 'required' : false"
          @input="$emit('update:modelValue', $event.target.value)"
      />
      <div v-if="errors.has(name) || (errorKey && errors.has(errorKey))" class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
        <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
      </div>
    </div>
    <p v-if="(errors.has(name) && errors.get(name)) || (errorKey && errors.has(errorKey))" class="mt-2 text-sm text-red-600" id="email-error">{{ errors.get(name) }}</p>
  </div>
</template>
<script setup>
import { ExclamationCircleIcon } from '@heroicons/vue/20/solid'

defineProps({
  'name': {
    type: String,
    required: true,
  },
  'type': {
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
  'disabled': {
    type: Boolean,
    default: false
  },
  'errors': {
    type: Object,
    required: true,
  },
  'errorKey': {
    type: String,
    default: '',
  }
})
defineEmits(['update:modelValue'])
</script>
