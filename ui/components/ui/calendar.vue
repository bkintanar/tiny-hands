<template>
  <div class="lg:col-start-8 lg:col-end-13 lg:row-start-1 xl:col-start-9">
    <div class="flex items-center text-gray-900">
      <h2 class="flex-auto font-semibold text-gray-900">{{ moment(date).format('MMMM YYYY') }}</h2>
      <button type="button" @click.prevent="prev" class="-my-1.5 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
        <span class="sr-only">Previous month</span>
        <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
      </button>
      <button type="button" @click.prevent="next" class="-my-1.5 -mr-1.5 ml-2 flex flex-none items-center justify-center p-1.5 text-gray-400 hover:text-gray-500">
        <span class="sr-only">Next month</span>
        <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
      </button>
    </div>
    <div class="mt-6 grid grid-cols-7 text-center text-xs leading-6 text-gray-500">
      <div>S</div>
      <div>M</div>
      <div>T</div>
      <div>W</div>
      <div>T</div>
      <div>F</div>
      <div>S</div>
    </div>
    <div class="isolate mt-2 grid grid-cols-7 gap-px rounded-lg bg-gray-200 text-sm shadow ring-1 ring-gray-200">
      <ui-calendar-button
        v-for="(day, index) in daysToDisplay"
        :d="date"
        :isSelected="selectedDate === day.format('YYYY-MM-DD')"
        :isToday="today === day.format('YYYY-MM-DD')"
        :count="daysToDisplay.length"
        :index="index"
        :date="day"
        @selected="selected($event)"
      >
        {{ day.date() }}
      </ui-calendar-button>
    </div>
    <section v-if="today" class="mt-12">
      <h2 class="font-semibold text-gray-900">Schedule for <time datetime="2022-01-21">{{ moment(selectedDate).format('MMMM D, YYYY') }}</time></h2>
      <ol class="mt-4 space-y-1 text-sm leading-6 text-gray-500">
        <li v-for="meeting in meetings" :key="meeting.id" class="group flex items-center space-x-4 rounded-xl py-2 px-4 focus-within:bg-gray-100 hover:bg-gray-100">
          <img :src="meeting.imageUrl" alt="" class="h-10 w-10 flex-none rounded-full" />
          <div class="flex-auto">
            <p class="text-gray-900">{{ meeting.name }}</p>
            <p class="mt-0.5">
              <time :datetime="meeting.startDatetime">{{ meeting.start }}</time> -
              <time :datetime="meeting.endDatetime">{{ meeting.end }}</time>
            </p>
          </div>
          <Menu as="div" class="relative opacity-0 focus-within:opacity-100 group-hover:opacity-100">
            <div>
              <MenuButton class="-m-2 flex items-center rounded-full p-1.5 text-gray-500 hover:text-gray-600">
                <span class="sr-only">Open options</span>
                <EllipsisVerticalIcon class="h-6 w-6" aria-hidden="true" />
              </MenuButton>
            </div>

            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Edit</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Cancel</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
        </li>
      </ol>
    </section>
    <button type="button" class="mt-8 w-full rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Add event</button>
  </div>
</template>
<script setup>
import moment from "moment"
import { onMounted } from "vue";
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'
import { EllipsisVerticalIcon } from '@heroicons/vue/24/outline'
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

const meetings = [
  {
    id: 1,
    name: 'Leslie Alexander',
    imageUrl:
      'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
    start: '1:00 PM',
    startDatetime: '2022-01-21T13:00',
    end: '2:30 PM',
    endDatetime: '2022-01-21T14:30',
  }
]

const props = defineProps({
  'd': {
    type: String,
    required: true,
  },
  'startOfWeek': {
    type: Number,
    default: 1,
  }
})

const today = ref('')
const selectedDate = ref('')
const startOfMonth = ref(moment())
const endOfMonth = ref(moment())
const daysToDisplay = ref([])
const date = ref('')

function selected(event) {
  selectedDate.value = event

  if (moment(selectedDate.value).month() !== moment(date.value).month()) {
    date.value = moment(selectedDate.value, 'YYYY-MM-DD').startOf('month').format('YYYY-MM-DD')

    redraw()
  }
}

function redraw() {
  let m

  daysToDisplay.value = []

  startOfMonth.value = moment(date.value).startOf('month')
  endOfMonth.value = moment(date.value).endOf('month')

  today.value = moment().format('YYYY-MM-DD')

  if (props.startOfWeek !== startOfMonth.value.day()) {
    moment(startOfMonth.value.subtract(startOfMonth.value.day(), 'days'))
  }

  // check if end of month's day of the week
  // is 6. If not, add currentDays from next months
  if (endOfMonth.value.day() !== 6) {
    endOfMonth.value.add(6 - endOfMonth.value.day()-1, 'day')
  }

  for (m = moment(startOfMonth.value); m.diff(endOfMonth.value) <= 0; m.add(1, 'days')) {
    daysToDisplay.value.push(moment(m))
  }

  // workaround
  if(daysToDisplay.value[daysToDisplay.value.length - 1].day() === 5) {
    daysToDisplay.value.push(moment(m))
  }
}

function prev() {
  date.value = moment(date.value, 'YYYY-MM-DD').subtract(1, 'month').startOf('month').format('YYYY-MM-DD')

  redraw()
}

function next() {
  date.value = moment(date.value, 'YYYY-MM-DD').add(1, 'month').startOf('month').format('YYYY-MM-DD')

  redraw()
}

onMounted(() => {
  date.value = props.d

  selectedDate.value = moment().format('YYYY-MM-DD')

  redraw()
})
</script>
