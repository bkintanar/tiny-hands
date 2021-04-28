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
        {{ $t('register_an_account') }}
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" @submit.prevent="register">
          <ui-input
            name="name"
            type="text"
            :error="form.errors.get('name')"
            :has-error="form.errors.has('name')"
            :value="form.name"
            @update:modelValue="form.name = $event"
          >
            {{ $t('name') }}
          </ui-input>

          <ui-input
            name="email"
            type="email"
            :error="form.errors.get('email')"
            :has-error="form.errors.has('email')"
            :value="form.email"
            :status="status"
            @update:modelValue="form.email = $event"
          >
            {{ $t('email_address') }}
          </ui-input>

          <ui-input
            name="password"
            type="password"
            autocomplete="current-password"
            :has-error="form.errors.has('password')"
            :value="form.password"
            @update:modelValue="form.password = $event"
          >
            {{ $t('password') }}
          </ui-input>

          <ui-input
            name="password_confirmation"
            type="password"
            :has-error="form.errors.has('password')"
            :custom-error="form.errors.get('password')"
            :has-custom-error="form.errors.get('password')"
            :value="form.password_confirmation"
            @update:modelValue="form.password_confirmation = $event"
          >
            {{ $t('password_confirmation') }}
          </ui-input>

          <div>
            <ui-button :loading="form.busy">{{ $t('register') }}</ui-button>
          </div>
        </form>
      </div>
      <ui-language-dropdown :show-label="true" />
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'auth',
  middleware: 'guest',
  data: () => ({
    status: '',
    error: '',
    form: new Form({
      token: '',
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    }),
    remember: false,
  }),

  head() {
    return { title: this.$t('register') }
  },

  methods: {
    async register() {
      let data

      // Submit the form.
      try {
        const response = await this.form.post('/register')
        data = response.data
      } catch (e) {
        return
      }

      this.status = data.status

      // Redirect to verification notice.
      this.$router.push({ name: 'registration.notice' })
    },
  },
}
</script>
