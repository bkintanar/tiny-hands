<template>
  <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <img class="mx-auto h-12 w-auto" src="/logo.png" alt="Your Company" />
      <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">{{ $t('reset_your_password') }}</h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        {{ $t('reset_your_password_description') }}
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="#" @submit.prevent="send" @keydown="form.onKeydown($event)">
          <!-- email input -->
          <ui-input v-model="form.email" :errors="form.errors" error-key="email" required name="email" type="email">{{ $t('email_address') }}</ui-input>

          <div>
            <ui-button :loading="form.busy" :loading-text="$t('sending_password_reset_email')">{{ $t('send_password_reset_email' )}}</ui-button>
          </div>
        </form>
        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
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
                <ui-button native-type="button" type="secondary">
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
import {useNuxtApp} from "#app";
import { ref } from "vue";
import { notify } from "@kyvg/vue3-notification";

definePageMeta({
  layout: 'default',
  middleware: ['check-auth', 'guest'],
})

const form = ref({
  email: '',
  busy: false,

  onKeydown(event) {
    this.errors.props = []
  },

  params() {
    return {
      email: this.email,
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

      return response._data._rawValue
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

async function send() {
  await form.value.post('/password/email')

  if (!form.value.errors.props) {
    return navigateTo({name: 'index'})
  }
}
</script>
