import {defineNuxtPlugin} from '#app'
import { getBaseURL } from "~/utils";

export default defineNuxtPlugin(nuxtApp => {
  nuxtApp.provide(
    'apiFetch',
    $fetch.create({ baseURL: getBaseURL(), credentials: 'include'})
  )
})
