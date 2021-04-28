import Cookies from 'js-cookie'

// state
export const state = () => ({
  locale: 'en',
  locales: {
    en: '🇺🇸 English',
    nl: '🇳🇱 Dutch',
    es: '🇪🇸 Español',
  },
})

// getters
export const getters = {
  locale: (state) => state.locale,
  locales: (state) => state.locales,
}

// mutations
export const mutations = {
  SET_LOCALE(state, { locale }) {
    state.locale = locale
  },
}

// actions
export const actions = {
  setLocale({ commit }, { locale }) {
    commit('SET_LOCALE', { locale })

    Cookies.set('locale', locale, { expires: 365 })
  },
}
