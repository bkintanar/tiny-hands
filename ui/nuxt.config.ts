import en from './lang/en.json'
import es from './lang/es.json'
import nl from './lang/nl.json'

import {routes} from './routes.js'

// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  runtimeConfig: {
    public: {
      BASE_URL: process.env.BASE_URL_API,
    }
  },
  modules: [
    '@nuxtjs/i18n',
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
  ],
  i18n: {
    strategy: 'no_prefix',
    locales: [
      {
        code: 'en',
        name: '🇺🇸 English',
      },
      {
        code: 'es',
        name: '🇪🇸 Español'
      },
      {
        code: 'nl',
        name: '🇳🇱 Dutch'
      }
    ],
    defaultLocale: 'en',
    vueI18n: {
      legacy: false,
      locale: 'en',
      messages: {
        en, es, nl
      }
    }
  },
  hooks: {
    'pages:extend': (pages) => {
      routes.forEach((route) => {
        pages.push(route)
      })
    }
  }
})
