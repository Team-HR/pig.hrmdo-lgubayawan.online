<template>
  <div class="w-8 mx-auto border-round-md bg-white p-5 shadow-5">
    <slot />
    <Toast />
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
};
</script>