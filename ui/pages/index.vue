<template>
  <div></div>
</template>
<script>
export default {
  middleware: 'verified',
  created() {
    this.$router.push({ name: 'login' })
  },
}
</script>
