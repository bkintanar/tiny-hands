<template>
  <button type="button" @click.prevent="selected()" :class="[
    props.date.day() === 0 && props.index === 0 ? 'rounded-tl-lg': '',
    props.date.day() === 6 && props.index === 6 ? 'rounded-tr-lg': '',
    props.date.day() === 0 && props.index === props.count-7 ? 'rounded-bl-lg': '',
    props.date.day() === 6 && props.index === props.count-1 ? 'rounded-br-lg': '',

    props.isToday || props.isSelected ? 'font-semibold':'',
    props.isSelected ? 'text-white': '',
    props.isToday && !props.isSelected ? 'text-indigo-600':'',

    thisMonth() ? 'bg-white': 'bg-gray-50',
    thisMonth() && !props.isSelected && !props.isToday ? 'text-gray-900': '',
    !thisMonth() && !props.isSelected && !props.isToday ? 'text-gray-400': '',

    'py-1.5 hover:bg-gray-100 focus:z-10'
  ]">
    <time :datetime="props.date.format('YYYY-MM-DD')" :class="[
      isToday && isSelected? 'bg-indigo-600':'',
      !isToday && isSelected? 'bg-gray-900':'',
      'mx-auto flex h-7 w-7 items-center justify-center rounded-full'
    ]">
      <slot />
    </time>
  </button>
</template>
<script setup>
import moment from "moment"

const props = defineProps({
  'd': {
    type: String,
  },
  'date': {
    type: moment,
  },
  'index': {
    type: Number
  },
  'count': {
    type: Number
  },
  'isToday': {
    type: Boolean,
  },
  'isSelected': {
    type: Boolean,
  },
})

const emit = defineEmits(['selected'])

function thisMonth() {
  return (moment(props.date)).format('M') === moment(props.d).format('M')
}

function selected() {
  emit('selected', props.date.format('YYYY-MM-DD'))
}
</script>
