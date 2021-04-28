import { join } from 'path'
import { copySync, removeSync } from 'fs-extra'
import * as dotenv from 'dotenv'

dotenv.config()

export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'Loading',
    titleTemplate: '%s · Tiny Hands',
    htmlAttrs: {
      lang: 'en',
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
    ],
    link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }],
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '~plugins/axios',
    '~plugins/i18n',
    '~plugins/nuxt-client-init',
    '~plugins/vform',
    '~plugins/notification',
    { src: '~plugins/infiniteloading', ssr: false },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    '@nuxt/postcss8',
    '@nuxtjs/eslint-module',
    '@nuxtjs/stylelint-module',
    '@nuxtjs/tailwindcss',
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    '@nuxtjs/router',
  ],

  router: {
    middleware: ['check-auth', 'locale'],
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    credentials: true,
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},

  hooks: {
    generate: {
      done(generator) {
        // Copy dist files to public/_nuxt
        if (
          generator.nuxt.options.dev === false &&
          generator.nuxt.options.mode === 'spa'
        ) {
          const publicDir = join(generator.nuxt.options.rootDir, 'build')

          removeSync(publicDir)

          copySync(
            join(generator.nuxt.options.generate.dir, '_nuxt'),
            join(publicDir, '_nuxt')
          )

          copySync(
            join(generator.nuxt.options.generate.dir, '200.html'),
            join(publicDir, 'index.html')
          )

          copySync(join(generator.nuxt.options.rootDir, 'static'), publicDir)

          removeSync(generator.nuxt.options.generate.dir)
        }
      },
    },
  },
}
