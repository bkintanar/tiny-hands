import { useAuthStore } from '~/store/auth'
import { useLangStore } from '~/store/lang'
import { getBaseURL } from '~/utils'

export const useTinyHandsFetch = async (url, options) => {
  const { $apiFetch } = useNuxtApp()

  const authStore = useAuthStore()
  const langStore = useLangStore()

  const token = authStore.getToken
  const locale = langStore.getLocale

  let headers = {
    accept: 'application/json',
    authorization: '',
    'accept-language': '',
  }

  if (token !== null) {
    headers.authorization = `Bearer ${token}`
  }

  if (locale !== null) {
    headers['accept-language'] = locale
  }

  Object.keys(headers).forEach(key => {
    if (headers[key] === null || headers[key] === undefined) {
      delete headers[key]
    }
  })

  return await $apiFetch(url, {
    ...options,
    async onRequest ({ options }) {
      options.headers = headers
      options.baseURL = getBaseURL()
    }
  })
}
