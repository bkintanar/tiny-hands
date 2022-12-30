<template><div></div></template>
<script setup>
import {useAuthStore} from "~/store/auth";
import {useNuxtApp} from "nuxt/app";
import {notify} from "@kyvg/vue3-notification";
import {onMounted} from "vue"; useNuxtApp();

definePageMeta({
  layout: 'default',
  middleware: ['check-auth', 'auth'],
})

const { t } = useI18n()
const authStore = useAuthStore()
const route = useRoute()

const params = {
  expires: route.query.expires,
  hash: route.query.hash,
  signature: route.query.signature,
}

onMounted(async () => {
  const user = await authStore.fetchUser()

  if (user && user.email_verified_at) {
    return navigateTo({name: 'index'})
  }

  try {
    await useCustomFetch('/email/verify/' + route.params.id, {
      params,
      method: 'get',
    })

    await authStore.fetchUser()

    notify({
      title: t('successful'),
      text: t('email_successfully_verified'),
      type: 'success',
      duration: 5000,
    })

    return navigateTo({name: 'index'})

  } catch (err) {

    notify({
      title: t('whoops'),
      text: err.message,
      type: 'error',
      duration: 5000,
    })

    if (err.message) {
      return navigateTo({name: 'verification.index'})
    }
  }
})


</script>
