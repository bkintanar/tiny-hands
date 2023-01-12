import { defineStore } from 'pinia'
import Cookies from 'js-cookie'

export const useLangStore = defineStore('lang-store', {
  state: () => ({
    locale: null,
  }),

  actions: {
    async setLocale (locale) {
      const { $i18n } = useNuxtApp()
      const { setLocale } = $i18n

      this.teste = locale
      await setLocale(locale)

      Cookies.set('locale', locale, { expires: 365 })
    },
  },

  getters: {
    getLocale: state => state.teste,
  },
})
