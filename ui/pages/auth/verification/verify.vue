<template><div></div></template>

<script>
import Form from 'vform'
import { mapGetters, mapActions } from 'vuex'

export default {
  layout: 'default',
  middleware: 'auth',
  data: () => ({
    status: '',
    form: new Form({}),
  }),

  head() {
    return { title: this.$t('Verify your account') }
  },

  computed: {
    ...mapGetters({
      token: 'auth/token',
      user: 'auth/user',
    }),
  },

  async mounted() {
    await this.fetchUser()

    if (this.user.email_verified_at) {
      const name = 'index'
      this.$router.push({ name })
    }
  },

  async beforeCreate() {
    const params = {
      expires: this.$route.query.expires,
      hash: this.$route.query.hash,
      signature: this.$route.query.signature,
    }

    try {
      await this.$axios.get('/email/verify/' + this.$route.params.id, {
        params,
      })

      await this.fetchUser()

      this.$router.push({ name: 'index' })

      this.$notify({
        title: this.$t('successful'),
        text: this.$t('email_successfully_verified'),
        type: 'success',
        duration: 5000,
      })
    } catch (e) {
      this.$router.push({ name: 'verification.index' })

      this.$notify({
        title: this.$t('whoops'),
        text: e.response.data.message,
        type: 'error',
        duration: 5000,
      })
    }
  },

  methods: {
    ...mapActions({
      fetchUser: 'auth/fetchUser',
    }),
  },
}
</script>
