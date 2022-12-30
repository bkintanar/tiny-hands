import { defineStore } from 'pinia'
import Cookies from 'js-cookie'
import { useTinyHandsFetch } from '~/composables/useTinyHandsFetch'

export const useAuthStore = defineStore('auth-store', {
  state: () => ({
    user: null,
    token: null,
    roles: ['admin', 'moderator', 'member'],
  }),

  actions: {
    saveToken (token, remember) {
      this.token = token

      Cookies.set('token', token, { expires: remember ? 365 : null })
    },

    saveUser (user) {
      this.user = user
    },

    async fetchUser () {
      if (this.token !== null) {
        try {
          const response = await useTinyHandsFetch('/user')

          this.saveUser(response.data)

          return this.getUser
        } catch (err) {
          await this.logout()
        }
      }
    },

    async logout () {
      try {
        await useTinyHandsFetch('/logout', { method: 'post' })

        this.user = null
        this.token = null

      } catch (err) {}

      Cookies.remove('token')
    }
  },

  getters: {
    getUser: state => state.user,
    getToken: state => state.token,
    getSupportedRoles: state => state.roles,
    check: state => state.user !== null,
  },
})
