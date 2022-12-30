<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img
        class="mx-auto h-12 w-auto"
        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
        alt="Your Company"
      >
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
        {{ $t('verify_your_account') }}
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        {{ $t('verify_your_account_description') }}
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form
          class="space-y-6"
          action="#"
          @submit.prevent="resend"
          @keydown="form.onKeydown($event)"
        >
          <div>
            <ui-button
              :loading="form.busy"
              :loading-text="$t('resending_verification_email')"
            >
              {{ $t('resend_verification_email') }}
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
                {{ $t('not_ready_to_verify_your_account') }}
              </span>
            </div>
          </div>

          <div class="mt-6">
            <div>
              <span class="w-full inline-flex rounded-md shadow-sm">
                <ui-button
                  native-type="button"
                  type="secondary"
                  @click.prevent="logout"
                >
                  {{ $t('logout') }}
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

const { t } = useI18n()

definePageMeta({
  layout: 'default',
  middleware: ['check-auth', 'auth'],
})

const form = ref({
  email: '',
  busy: false,

  onKeydown (event) {
    this.errors.props = []
  },

  params () {
    return {
      email: this.email,
    }
  },

  errors: {
    props: [],

    has (key) {
      return this.props?.hasOwnProperty(key) ?? false
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

      const response = await useTinyHandsFetch(url, {
        method: 'POST',
        body: this.params()
      })

      this.busy = false

      return response
    } catch (err) {
      this.busy = false

      if (err.data.errors !== undefined) {
        this.errors.props = err.data.errors
      } else {
        this.errors.props = err.data
      }
    }
  }
})

async function resend () {
  const authStore = useAuthStore()

  const user = await authStore.fetchUser()

  console.log(user)

  if (user.email_verified_at) {
    return navigateTo({ name: 'index' })
  }

  try {
    await form.value.post('/email/resend')

    notify({
      title: t('successful'),
      text: t('verify_email_address'),
      type: 'success',
      duration: 5000,
    })
  } catch (e) {
    notify({
      title: t('whoops'),
      text: e.response.data.message,
      type: 'error',
      duration: 5000,
    })
  }
}

async function logout () {
  const authStore = useAuthStore()

  await authStore.logout()

  return navigateTo({ name: 'login' })
}
</script>
