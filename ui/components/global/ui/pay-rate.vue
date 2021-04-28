<template>
  <div>
    <div class="flex">
      <label
        for="pay"
        class="flex-1 min-w-0 block w-full text-sm font-medium text-gray-700"
      >
        {{ $t('pay_rate') }}
      </label>
    </div>
    <div class="mt-1 flex rounded-md shadow-sm">
      <input
        id="pay"
        v-model="modelInputValue"
        type="text"
        name="pay"
        class="flex-1 min-w-0 block w-full py-2 text-right rounded-none shadow-sm border-r-0 rounded-l-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        :class="{
          'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': hasError,
          'border-gray-300 focus:border-indigo-500 focus:shadow-outline-blue focus:border-blue-300': !hasError,
        }"
      />
      <span
        class="inline-flex items-center border border-r-0 border-l-0 shadow-sm text-right text-gray-500 sm:text-sm"
        :class="{
          'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': hasError,
          'border-gray-300 focus:border-indigo-500 focus:shadow-outline-blue focus:border-blue-300': !hasError,
        }"
      >
        /
      </span>
      <div class="relative">
        <select
          id="rate"
          v-model="modelSelectValue"
          type="text"
          name="rate"
          class="flex-1 min-w-0 block w-full py-2 border-l-0 rounded-none shadow-sm rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
          :class="{
            'border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red': hasError,
            'border-gray-300 focus:border-indigo-500': !hasError,
          }"
        >
          <option disabled="disabled" selected>
            {{ $t('please_select_one') }}
          </option>
          <option value="year">Year</option>
        </select>
        <svg-exclamation-circle :has-error="hasError" :is-select="true" />
      </div>
    </div>
    <p v-if="hasError" class="mt-2 text-sm text-red-600">
      {{ error }}
    </p>
  </div>
</template>
<script>
export default {
  props: {
    error: {
      type: String,
      default: '',
    },

    hasError: {
      type: Boolean,
      default: false,
    },

    inputValue: {
      type: String,
      default: '',
    },

    selectValue: {
      type: String,
      default: '',
    },
  },
  computed: {
    modelInputValue: {
      get() {
        return this.inputValue
      },
      set(inputValue) {
        this.$emit(
          'update:modelInputValue',
          inputValue ? inputValue.toString() : inputValue
        )
      },
    },
    modelSelectValue: {
      get() {
        return this.selectValue
      },
      set(selectValue) {
        this.$emit(
          'update:modelSelectValue',
          selectValue ? selectValue.toString() : selectValue
        )
      },
    },
  },
}
</script>
