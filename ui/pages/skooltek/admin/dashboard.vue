<template>
  <app-main>
    <main>
      <div class="bg-white shadow">
        <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-full lg:px-8">
          <div class="py-6 md:flex md:items-center md:justify-between lg:border-gray-200">
            <div class="min-w-0 flex-1">
              <!-- Profile -->
              <div class="flex items-center">
                <img class="hidden h-16 w-16 rounded-full sm:block" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.6&w=256&h=256&q=80" alt="" />
                <div>
                  <div class="flex items-center">
                    <img class="h-16 w-16 rounded-full sm:hidden" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.6&w=256&h=256&q=80" alt="" />
                    <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">Good morning, {{ user?.name }}</h1>
                  </div>
                  <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                    <dt class="sr-only">Company</dt>
                    <dd class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6">
                      <BuildingOfficeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                      Duke street studio
                    </dd>
                    <dt class="sr-only">Account status</dt>
                    <dd class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0">
                      <CheckCircleIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400" aria-hidden="true" />
                      Verified account
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
            <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
              <button type="button" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">Add money</button>
              <button type="button" class="inline-flex items-center rounded-md border border-transparent bg-cyan-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">Send money</button>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-8">
        <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
          <h2 class="text-lg font-medium leading-6 text-gray-900">Overview</h2>
          <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Card -->
            <div v-for="card in cards" :key="card.name" class="overflow-hidden rounded-lg bg-white shadow">
              <div class="p-5">
                <div class="flex items-center">
                  <div class="flex-shrink-0">
                    <component :is="card.icon" class="h-6 w-6 text-gray-400" aria-hidden="true" />
                  </div>
                  <div class="ml-5 w-0 flex-1">
                    <dl>
                      <dt class="truncate text-sm font-medium text-gray-500">{{ card.name }}</dt>
                      <dd>
                        <div class="text-lg font-medium text-gray-900">{{ card.amount }}</div>
                      </dd>
                    </dl>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-5 py-3">
                <div class="text-sm">
                  <a :href="card.href" class="font-medium text-cyan-700 hover:text-cyan-900">View all</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-8">
        <div class="mx-auto max-w-full px-4 sm:px-6 lg:px-8">
          <h2 class="text-lg font-medium leading-6 text-gray-900">Student Applications</h2>
        </div>
      </div>
    </main>
  </app-main>
</template>
<script setup>
const { t } = useI18n()

definePageMeta({
  layout: 'default',
  middleware: ['check-auth', 'auth', 'verified', 'admin']
})

const pages = [
  { name: '', href: '#', current: false },
]

import {
  ClockIcon,
  CreditCardIcon,
  DocumentChartBarIcon,
  HomeIcon,
  ScaleIcon,
  UserGroupIcon,
} from '@heroicons/vue/24/outline'
import {
  BuildingOfficeIcon,
  CheckCircleIcon,
} from '@heroicons/vue/20/solid'
import {onMounted} from "vue";
import {useAuthStore} from "../../../store/auth";

const navigation = [


  { name: 'Home', href: '#', icon: HomeIcon, current: true },
  { name: 'History', href: '#', icon: ClockIcon, current: false },
  { name: 'Balances', href: '#', icon: ScaleIcon, current: false },
  { name: 'Cards', href: '#', icon: CreditCardIcon, current: false },
  { name: 'Recipients', href: '#', icon: UserGroupIcon, current: false },
  { name: 'Reports', href: '#', icon: DocumentChartBarIcon, current: false },
]
const cards = [


  { name: 'Students', href: '#', icon: ScaleIcon, amount: '14' },
  { name: 'Teachers', href: '#', icon: ScaleIcon, amount: '2' },
  { name: 'Parents', href: '#', icon: ScaleIcon, amount: '18' },
  { name: 'Pending Admission', href: '#', icon: ScaleIcon, amount: '1' },
  // More items...
]

const sidebarOpen = ref(false)
const user = ref({})
const authStore = useAuthStore()

onMounted(() => {
  user.value = authStore.getUser
})
</script>
