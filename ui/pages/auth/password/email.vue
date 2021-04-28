<template>
  <div
    class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
  >
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <nuxt-link
        :to="{ name: 'index' }"
        class="font-medium text-indigo-600 hover:text-indigo-500"
      >
        <img
          class="mx-auto h-12 w-auto"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt="Workflow"
        />
      </nuxt-link>
      <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        {{ $t('reset_your_password') }}
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        {{ $t('reset_your_password_description') }}
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form
          class="space-y-6"
          @submit.prevent="send"
          @keydown="form.onKeydown($event)"
        >
          <ui-input
            name="email"
            type="email"
            :has-error="form.errors.has('email')"
            :value="form.email"
            @update:modelValue="form.email = $event"
          >
            {{ $t('email_address') }}
          </ui-input>

          <div>
            <ui-button :loading="form.busy">
              {{ $t('send_password_reset_email') }}
            </ui-button>
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
                <nuxt-link :to="{ name: 'register' }" class="w-full">
                  <ui-button native-type="button" type="secondary">
                    {{ $t('register_an_account') }}
                  </ui-button>
                </nuxt-link>
              </span>
            </div>
          </div>
        </div>
      </div>
      <ui-language-dropdown :show-label="true" />
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import { forEach } from 'lodash-es'

export default {
  layout: 'default',

  data: () => ({
    status: '',
    form: new Form({
      email: '',
    }),
  }),

  head() {
    return { title: this.$t('reset_password') }
  },

  methods: {
    async send() {
      let data

      try {
        const response = await this.form.post('/password/email')
        data = response.data

        this.status = data.status

        this.$notify({
          title: this.$t('successful'),
          text: data.status,
          type: 'success',
        })

        this.$router.push({ name: 'index' })
      } catch (e) {
        if (e.response.data.errors) {
          forEach(e.response.data.errors, (error) => {
            this.$notify({
              title: e.response.data.message,
              text: error[0],
              type: 'error',
              duration: 5000,
            })
          })
        } else if (e.response.data.email) {
          this.$notify({
            title: this.$t('whoops'),
            text: e.response.data.email,
            type: 'error',
            duration: 5000,
          })
        }

        return
      }

      this.form.reset()
    },
  },
}
</script>
