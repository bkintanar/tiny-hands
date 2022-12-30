import {useAuthStore} from "~/store/auth";
import {useLangStore} from "~/store/lang";
import {getBaseURL} from "~/utils";

export const useCustomFetch = (url, options) => {

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
    headers.authorization = "Bearer " + token
  }

  if (locale !== null) {
    headers['accept-language'] = locale
  }

  Object.keys(headers).forEach(key => {
    if (headers[key] === null || headers[key] === undefined) {
      delete headers[key];
    }
  });

  return useFetch(url, {
    ...options,
    onResponse({ request, response, options }) {
      // Process the response data
      return response._data
    },
    async onRequest({ request, options }) {
      options.headers = headers
      options.baseURL = getBaseURL()
    },
    async onRequestError({ request, options, error }) {
      console.log('[fetch request error]')
    }
  })
}
