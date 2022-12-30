import { defineNuxtRouteMiddleware } from '#app'
import {useAuthStore} from "~/store/auth";
import {useLangStore} from "~/store/lang";

export default defineNuxtRouteMiddleware(async (to, from ) => {
  const authStore = useAuthStore()
  const langStore = useLangStore()

  const tokenInCookie = useCookie('token').value
  const localeInCookie = useCookie('locale').value

  if (tokenInCookie && !authStore.getToken) {
    authStore.saveToken(tokenInCookie)
  }

  if (!authStore.check && authStore.getToken != null) {
    await authStore.fetchUser()
  }

  if (localeInCookie) {
    await langStore.setLocale(localeInCookie)
  }
})
