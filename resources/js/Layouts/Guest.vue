<template>
  <navbar>
    <template #links>
      <!-- <a
        href="#responsive-header"
        class="
          block
          mt-4
          lg:inline-block lg:mt-0
          text-teal-100
          hover:text-white
          mr-4
        "
      >
        Rating Scale Matrix
      </a> -->
    </template>
    <template #right-items>
      <!-- <inertia-link
        href="login"
        class="
          block
          mt-4
          lg:inline-block lg:mt-0
          text-teal-100
          hover:text-white
          mr-4
        "
      >
        Login
      </inertia-link>
      <inertia-link
        href="register"
        class="
          block
          mt-4
          lg:inline-block lg:mt-0
          text-teal-100
          hover:text-white
          mr-4
        "
      >
        Register
      </inertia-link> -->
    </template>
  </navbar>
  <div class="container mx-auto px-4">
    <slot />
  </div>
</template>
<script>
import Navbar from "@/Components/Navbar.vue";
export default {
  components: {
    Navbar,
  },
};
</script>