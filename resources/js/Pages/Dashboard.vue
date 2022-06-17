<template>
  <auth-layout>
    <div class="container justify-center w-full">
      <div class="w-1/2 mx-auto m-10 shadow-xl p-10">
        <div class="text-xl text-teal-500">You're logged in!</div>
      </div>
    </div>
  </auth-layout>
</template>

<script>
import AuthLayout from "@/Layouts/Authenticated";

export default {
  components: {
    AuthLayout,
  },
};
</script>
