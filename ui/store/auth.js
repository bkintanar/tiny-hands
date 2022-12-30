import {defineStore} from 'pinia'
import {useNuxtApp} from "#app";
import Cookies from 'js-cookie'
import {useCustomFetch} from "~/composables/useCustomFetch";

export const useAuthStore = defineStore('auth-store', {
  state: () => ({
    user: null,
    token: null,
    roles: ['admin', 'teacher', 'parent', 'student'],
  }),

  actions: {
    saveToken(token, remember) {
      this.token = token

      Cookies.set('token', token, { expires: remember ? 365 : null })
    },

    saveUser(user) {
      this.user = user
    },

    async fetchUser() {
      if (this.token !== null) {
        try {
          const response = await useCustomFetch('/user')

          this.saveUser(response.data._rawValue.data)

          return this.getUser
        } catch (err) {
          await this.logout()
        }
      }
    },

    async logout() {
      try {
        await useCustomFetch('/logout')

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
