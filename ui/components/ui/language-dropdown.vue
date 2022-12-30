<template>
  <div
    class="flex items-center w-full justify-between"
    :class="{ 'mt-10 space-x-4': showLabel }"
  >
    <label
      v-show="showLabel"
      for="locale"
      class="block text-sm text-gray-900"
      :class="{ 'ml-2': showLabel }"
    >
      {{ $t('language') }}
    </label>

    <select
      id="locale"
      name="locale"
      v-model="locale"
      class="mt-1 block w-full pl-3 pr-5 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
      :class="{ 'mr-10': showLabel }"
      @change.prevent="setLocale(locale)"
    >
      <option disabled>{{ $t('select_a_language') }}</option>
      <option v-for="locale in locales" :key="locale.code" :value="locale.code">
        {{ locale.name }}
      </option>
    </select>
  </div>
</template>
<script setup>
import { useLangStore } from "~/store/lang";

const { locale, locales } = useI18n()

defineProps({
  'showLabel': {
    type: Boolean,
    default: false,
  },
})

async function setLocale(locale) {
  const langStore = useLangStore()

  langStore.setLocale(locale)

  window.location.reload()
}
</script>
