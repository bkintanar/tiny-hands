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
      v-model="language"
      name="locale"
      class="mt-1 block w-full pl-3 pr-5 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
      :class="{ 'mr-10': showLabel }"
      @change.prevent="setLocale(language)"
    >
      <option disabled>{{ $t('select_a_language') }}</option>
      <option v-for="(locale, key) in locales" :key="key" :value="key">
        {{ locale }}
      </option>
    </select>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  props: {
    showLabel: {
      type: Boolean,
      default: false,
    },
  },

  data: () => ({
    language: '',
  }),

  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales',
  }),

  created() {
    this.language = this.locale
  },

  methods: {
    setLocale(locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
    },
  },
}
</script>
