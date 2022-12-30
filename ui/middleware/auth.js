import { defineNuxtRouteMiddleware } from '#app'
import {useAuthStore} from "~/store/auth";

export default defineNuxtRouteMiddleware(async(to, from ) => {
  const authStore = useAuthStore()

  if (!authStore.check) {
    return navigateTo({name: 'login'})
  }
})
