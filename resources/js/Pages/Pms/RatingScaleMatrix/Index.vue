<template>
  <auth-layout>
    <div class="container justify-center w-full">
      <div class="mx-auto mt-10 shadow-lg p-10 rounded-lg">
        <!-- container start -->
        {{ periods }}
        <!-- container end -->
      </div>
    </div>
  </auth-layout>
</template>

<script>
import AuthLayout from "@/Layouts/Authenticated";

export default {
  props: {
    periods: Array,
  },
  components: {
    AuthLayout,
  },
};
</script>
