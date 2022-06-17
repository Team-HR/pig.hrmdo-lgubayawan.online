<template>
  <navbar>
    <template #links>
      <inertia-link
        href="/dashboard"
        class="
          block
          mt-4
          lg:inline-block lg:mt-0
          text-teal-100
          hover:text-white
          mr-4
        "
      >
        Dashboard
      </inertia-link>
      <inertia-link
        href="/rating-scale-matrix"
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
      </inertia-link>
    </template>
    <template #right-items>
      <span class="mx-10 text-white">{{ $page.props.auth.user.username }}</span>

      <button
        @click="$inertia.post(route('logout'))"
        class="
          block
          mt-4
          lg:inline-block lg:mt-0
          text-teal-100
          hover:text-white
          mr-4
        "
      >
        Logout
      </button>
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