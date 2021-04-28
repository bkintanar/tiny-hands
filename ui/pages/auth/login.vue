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
        {{ $t('sign_in_to_your_account') }}
      </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form
          class="space-y-6"
          @submit.prevent="login"
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

          <ui-input
            name="password"
            type="password"
            autocomplete="current-password"
            :has-error="form.errors.has('email')"
            :value="form.password"
            @update:modelValue="form.password = $event"
          >
            {{ $t('password') }}
          </ui-input>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember_me"
                v-model="remember"
                name="remember_me"
                type="checkbox"
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              />
              <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                {{ $t('remember_me') }}
              </label>
            </div>

            <div class="text-sm">
              <nuxt-link
                :to="{ name: 'password.request' }"
                class="font-medium text-indigo-600 hover:text-indigo-500"
                >{{ $t('forgot_password') }}</nuxt-link
              >
            </div>
          </div>

          <div>
            <ui-button :loading="form.busy">{{ $t('sign_in') }}</ui-button>
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
import { mapGetters } from 'vuex'
import { forEach } from 'lodash-es'

export default {
  layout: 'default',
  middleware: 'guest',
  data: () => ({
    form: new Form({
      email: '',
      password: '',
    }),
    remember: false,
  }),

  head() {
    return { title: this.$t('login') }
  },

  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },

  methods: {
    async login() {
      let data

      // Submit the form.
      try {
        const response = await this.form.post('/login')
        data = response.data

        // Save the token.
        this.$store.dispatch('auth/saveToken', {
          token: data.token,
          remember: this.remember,
        })

        // Fetch the user.
        await this.$store.dispatch('auth/fetchUser')

        // Redirect to dashboard or verification page.
        if (!this.user.email_verified_at) {
          this.$router.push({ name: 'verification.index' })
        }

        this.$router.push({ name: 'dashboard.index' })

        this.$notify({
          title: this.$t('login_successful'),
          text: 'Welcome ' + this.user.name,
          type: 'success',
          duration: 5000,
        })
      } catch (e) {
        forEach(e.response.data.errors, (error, i) => {
          this.$notify({
            title: e.response.data.message,
            text: error[0],
            type: 'error',
            duration: 5000,
          })
        })
      }
    },
  },
}
</script>
