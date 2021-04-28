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
        {{ $t('register_successful') }}
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        {{ $t('register_successful_description') }}
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div>
        <span class="w-full inline-flex rounded-md shadow-sm">
          <ui-button native-type="button" type="secondary">
            <nuxt-link :to="{ name: 'login' }">{{ $t('back') }}</nuxt-link>
          </ui-button>
        </span>
      </div>
      <ui-language-dropdown :show-label="true" />
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'auth',
  data: () => ({
    status: '',
    error: '',
    form: new Form({
      token: '',
      email: '',
      password: '',
      password_confirmation: '',
    }),
  }),
  head() {
    return { title: this.$t('verify_email') }
  },

  created() {
    this.form.email = this.$route.query.email
    this.form.token = this.$route.params.token
  },
}
</script>
