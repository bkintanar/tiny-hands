import { defineNuxtRouteMiddleware } from '#app'
import {useAuthStore} from "~/store/auth";

export default defineNuxtRouteMiddleware(async(to, from ) => {
  const authStore = useAuthStore()

  const user = authStore.getUser

  if (user && !user.email_verified_at) {
    return navigateTo({name: 'verification.index'})
  }
})
