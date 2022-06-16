<template>
  <!-- <pig-layout> -->
  <div class="container mx-auto px-10 mt-2">

<!-- Jumbotron -->
<div class="p-6 shadow-lg rounded-lg bg-gray-100 text-gray-700">
  <h2 class="font-semibold text-3xl mb-5">VAC:PIG 2022</h2>
  <p>
          {{
            "Competency Gap Assessment on Agri-Extension Technicians of LGU Bayawan City".toUpperCase()
          }}
  </p>
  <hr class="my-6 border-gray-300" />

        <i-button
          @click="$inertia.get('/pig/2022/assessment-form')"
          class="btn-primary ml-5 mr-5"
          >Assessment Form</i-button
        >

        <i-button class="btn-success" disabled> Reports </i-button>
</div>
<!-- Jumbotron -->
  </div>
  <!-- </pig-layout> -->
</template>
<script>
import PigLayout from "@/Layouts/Pig.vue";
import IButton from "@/Components/Button";

export default {
  components: {
    PigLayout,
    IButton,
  },
};
</script>