<template>
  <navbar>
    <a
      href="#responsive-header"
      class="
        block
        mt-4
        lg:inline-block lg:mt-0
        text-teal-200
        hover:text-white
        mr-4
      "
    >
      Docs
    </a>
    <a
      href="#responsive-header"
      class="
        block
        mt-4
        lg:inline-block lg:mt-0
        text-teal-200
        hover:text-white
        mr-4
      "
    >
      Examples
    </a>
    <a
      href="#responsive-header"
      class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white"
    >
      Blog
    </a>
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