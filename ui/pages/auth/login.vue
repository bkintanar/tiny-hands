<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img
        class="mx-auto h-12 w-auto"
        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      >
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
        {{ $t('log_in_to_your_account') }}
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form
          class="space-y-6"
          action="#"
          @submit.prevent="login"
          @keydown="form.onKeydown($event)"
        >
          <!-- email input -->
          <ui-input
            v-model="form.email"
            :errors="form.errors"
            error-key="email"
            required
            name="email"
            type="email"
          >
            {{ $t('email_address') }}
          </ui-input>

          <!-- password input -->
          <ui-input
            v-model="form.password"
            :errors="form.errors"
            error-key="email"
            required
            name="password"
            type="password"
          >
            {{ $t('password') }}
          </ui-input>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember-me"
                v-model="form.rememberMe"
                name="remember-me"
                type="checkbox"
                :class="['h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500']"
              >
              <label
                for="remember-me"
                class="ml-2 block text-sm text-gray-900"
              >{{ $t('remember_me') }}</label>
            </div>

            <div class="text-sm">
              <nuxt-link
                to="/password/reset"
                :class="[
                  settings ? 'text-indigo-600' + ' ' + 'hover:text-indigo-500' :'',
                  'font-medium '
                ]"
              >
                {{ $t('forgot_password') }}
              </nuxt-link>
            </div>
          </div>

          <div>
            <ui-button
              :loading="form.busy"
              :loading-text="$t('logging_in_to_your_account')"
            >
              {{ $t('log_in_to_your_account') }}
            </ui-button>
          </div>
        </form>
        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300" />
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">
                {{ $t('dont_have_an_account') }}
              </span>
            </div>
          </div>

          <div class="mt-6">
            <div>
              <span class="w-full inline-flex rounded-md shadow-sm">
                <ui-button
                  native-type="button"
                  type="secondary"
                >
                  {{ $t('register_an_account') }}
                </ui-button>
              </span>
            </div>
          </div>
        </div>
      </div>
      <ui-language-dropdown :show-label="true" />
    </div>
  </div>
</template>
<script setup>
import { ref } from 'vue'
import { useAuthStore } from '~/store/auth'
import { notify } from '@kyvg/vue3-notification'
import { useTinyHandsFetch } from '~/composables/useTinyHandsFetch'

const { t } = useI18n()
const settings = ref({ color: 'emerald' })

definePageMeta({
  layout: 'default',
  middleware: ['check-auth', 'guest'],
})

const form = ref({
  email: 'admin@tiny-hands.test',
  password: 'password',
  rememberMe: '',
  busy: false,

  onKeydown (event) {
    this.errors.props = []
  },

  params () {
    return {
      email: this.email,
      password: this.password,
      remember: this.rememberMe,
    }
  },

  errors: {
    props: [],

    has (key) {
      return Object.prototype.hasOwnProperty.call(this.props, key) ?? false
    },

    get (key) {
      const keyValue = this.has(key)

      if (keyValue) {
        if (Array.isArray(this.props[key])) {
          return this.props[key][0]
        } else {
          return this.props[key]
        }
      }

      return null
    },
  },

  async post (url) {
    try {
      this.busy = true

      const response = await useTinyHandsFetch(url, { method: 'post', body: this.params() })

      this.busy = false

      return response
    } catch (err) {
      this.busy = false

      this.errors.props = err.data.errors
    }
  }
})

async function login () {
  const authStore = useAuthStore()

  const response = await form.value.post('/login')

  if (response) {

    authStore.saveToken(response.token, form.value.rememberMe)

    const user = await authStore.fetchUser()

    notify({
      title: t('login_successful'),
      text: 'Welcome ' + user.display_name,
      type: 'success',
      duration: 5000,
    })

    return navigateTo({ name: 'index' })
  }
}
</script>
