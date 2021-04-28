<template>
  <nav class="bg-white border-b border-gray-200 flex" aria-label="Breadcrumb">
    <ol class="max-w-screen-xl w-full px-4 flex space-x-4 sm:px-6 lg:px-6">
      <li class="flex">
        <div class="flex items-center">
          <nuxt-link
            :to="{ name: 'index' }"
            class="text-gray-400 hover:text-gray-500"
          >
            <!-- Heroicon name: solid/home -->
            <svg
              class="flex-shrink-0 h-5 w-5"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
              aria-hidden="true"
            >
              <path
                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
              />
            </svg>
            <span class="sr-only">{{ $t('home') }}</span>
          </nuxt-link>
        </div>
      </li>
      <li v-for="(item, i) in breadcrumbs" :key="i" class="flex">
        <div class="flex items-center">
          <svg
            class="flex-shrink-0 w-6 h-full text-gray-200"
            viewBox="0 0 24 44"
            preserveAspectRatio="none"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
          </svg>
          <nuxt-link
            class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700"
            :to="item.path"
          >
            {{ item.name }}
          </nuxt-link>
        </div>
      </li>
    </ol>
  </nav>
</template>
<script>
export default {
  props: {
    paramName: {
      type: String,
      default: '',
    },
  },
  computed: {
    breadcrumbs() {
      const breadcrumbs = []
      // eslint-disable-next-line array-callback-return
      this.$route.matched.map((item, i, { length }) => {
        if (!item.name.includes('employees.index')) {
          const breadcrumb = {}
          breadcrumb.path = item.path
          breadcrumb.name = this.$t(
            'route_' + (item.name.replace(/\./g, '_') || item.path)
          )

          // is last item?
          if (i === length - 1) {
            // is param route? .../.../:id
            if (item.regex.keys.length > 0) {
              breadcrumb.path = this.$route.path
              if (this.paramName) {
                breadcrumb.name = this.paramName
              } else {
                breadcrumb.name = ''
              }
            }
          }

          breadcrumbs.push(breadcrumb)
        }
      })

      return breadcrumbs
    },
  },
}
</script>
