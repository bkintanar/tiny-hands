<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="/logo.png" alt="Your Company" />
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">{{ $t('reset_password') }}</h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        {{ $t('reset_password_description') }}
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="#" @submit.prevent="reset" @keydown="form.onKeydown($event)">
          <!-- email input -->
          <ui-input v-model="form.email" :disabled="true" :errors="form.errors" required name="email" type="email">{{ $t('email_address') }}</ui-input>

          <ui-input v-model="form.password" :errors="form.errors" error-key="password" required name="password" type="password">{{ $t('password') }}</ui-input>

          <ui-input v-model="form.password_confirmation" :errors="form.errors" error-key="password" required name="password_confirmation" type="password">{{ $t('password_confirmation') }}</ui-input>
          <div>
            <ui-button :loading="form.busy" :loading-text="$t('resetting_password')">{{ $t('reset_password' )}}</ui-button>
          </div>
        </form>
      </div>
      <ui-language-dropdown :show-label="true" />
    </div>
  </div>
</template>
<script setup>
import {useNuxtApp} from "#app";
import { ref } from "vue";
import { notify } from "@kyvg/vue3-notification";
import {useCustomFetch} from "../../../composables/useCustomFetch";

const route = useRoute()
const { t } = useI18n()

definePageMeta({
  layout: 'default',
  middleware: ['check-auth', 'guest'],
})

const form = ref({
  email: route.query.email,
  token: route.params.token,
  password: '',
  password_confirmation: '',
  busy: false,

  onKeydown(event) {
    this.errors.props = []
  },

  params() {
    return {
      email: this.email,
      password: this.password,
      password_confirmation: this.password_confirmation,
      token: this.token,
    }
  },

  errors: {
    props: [],

    has(key) {
      return this.props?.hasOwnProperty(key) ?? false
    },

    get(key) {
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

  async post(url) {
    try {
      this.busy = true

      const response = await useCustomFetch(url, {
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

async function reset() {
  const response = await form.value.post('/password/reset')

  if (!form.value.errors.props.length) {
    notify({
      title: t('successful'),
      text: response.status,
      type: 'success',
      duration: 5000,
    })

    return navigateTo({name: 'index'})
  }
}
</script>
