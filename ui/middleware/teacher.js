import { defineNuxtRouteMiddleware } from '#app'
import {useAuthStore} from "~/store/auth";

export default defineNuxtRouteMiddleware(async(to, from ) => {
  const authStore = useAuthStore()

  const user = authStore.getUser

  if (!user.roles.includes('admin') && !user.roles.includes('teacher')) {
    return navigateTo({name: 'index'})
  }
})
