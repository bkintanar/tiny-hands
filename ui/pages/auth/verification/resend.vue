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
        {{ $t('Verify your account') }}
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Thanks for signing up! Before getting started, could you verify your
        email address by clicking on the link we just emailed to you? If you
        didn't receive the email, we will gladly send you another.
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form
          class="space-y-6"
          @submit.prevent="resend"
          @keydown="form.onKeydown($event)"
        >
          <div>
            <ui-button :loading="form.busy">
              {{ $t('resend_verification_email') }}
            </ui-button>
            <p v-if="status" class="mt-2 text-sm text-green-600">adsfadsf</p>
            <p v-if="error != false" class="mt-2 text-sm text-red-600">
              {{ error }}
            </p>
          </div>
        </form>

        <div class="mt-6">
          <div class="relative">
            <div class="absolute inset-0 flex items-center">
              <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
              <span class="px-2 bg-white text-gray-500">
                {{ $t('Not ready to verify your account?') }}
              </span>
            </div>
          </div>

          <div class="mt-6">
            <div>
              <span class="w-full inline-flex rounded-md shadow-sm">
                <a
                  href="#logout"
                  class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition duration-150 ease-in-out"
                  @click.prevent="exit"
                >
                  {{ $t('logout') }}
                </a>
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
import { mapGetters, mapActions } from 'vuex'

export default {
  layout: 'default',
  middleware: 'auth',
  data: () => ({
    status: '',
    error: false,
    form: new Form({}),
  }),

  head() {
    return { title: this.$t('Verify your account') }
  },

  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
  },

  async mounted() {
    await this.fetchUser()

    if (this.user.email_verified_at) {
      const name = 'dashboard'
      this.$router.push({ name })
    }
  },

  methods: {
    ...mapActions({
      fetchUser: 'auth/fetchUser',
    }),

    async exit() {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to index.
      this.$router.push({ name: 'index' })
    },

    async resend() {
      this.status = this.error = false

      // Fetch the user.
      await this.fetchUser()

      if (this.user.email_verified_at) {
        this.$router.push({ name: 'index' })
      }

      try {
        await this.form.post('/email/resend')

        this.$notify({
          title: this.$t('successful'),
          text: this.$t('verify_email_address'),
          type: 'success',
          duration: 5000,
        })

        this.form.reset()
      } catch (e) {
        this.$notify({
          title: this.$t('whoops'),
          text: e.response.data.message,
          type: 'error',
          duration: 5000,
        })
      }
    },
  },
}
</script>
