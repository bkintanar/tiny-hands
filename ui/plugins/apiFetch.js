import {defineNuxtPlugin, useCookie} from '#app'

import { useAuthStore } from '~/store/auth'
import { useLangStore } from '~/store/lang'
import { getBaseURL } from "~/utils";

export default defineNuxtPlugin(nuxtApp => {
  const authStore = useAuthStore()
  const langStore = useLangStore()

  const token = authStore.getToken
  const tokenInCookie = useCookie('token').value
  const locale = langStore.getLocale

  let headers = {
    accept: 'application/json',
  }

  if (token !== null) {
    headers.authorization = "Bearer " + token
  }

  if (locale !== null) {
    headers['accept-language'] = locale
  }

  nuxtApp.provide(
    'apiFetch',
    $fetch.create({ baseURL: getBaseURL(), credentials: 'include', headers})
  )
})
