<template>
  <div class="container px-10 mt-2">
    <!-- container start -->
    <i-button class="btn-primary" @click="$inertia.get('/')" v-if="!edit_form"
      >BACK</i-button
    >

    <div class="w-8/12 mx-auto">
        
    </div>
    <!-- container end -->
  </div>
</template>

<script>
import IButton from "@/Components/Button.vue";
export default {
  props: {},
  components: {
    IButton,
  },
  data() {
    return {};
  },
  methods: {},
  mounted() {},
};
</script>