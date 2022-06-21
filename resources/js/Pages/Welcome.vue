<template>
  <!-- <guest-layout v-if="!$page.props.auth.user"></guest-layout> -->
  <!-- <auth-layout v-else></auth-layout> -->

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

      <i-button
        @click="$inertia.get('/pig/2022/report')"
        class="btn-success"
        disabled
      >
        Reports (Work in Progress)
      </i-button>
    </div>
    <!-- Jumbotron -->
  </div>

  <div>
    <Card style="">
      <template #header>
        
      </template>
      <template #title> Vision Align Circle </template>
      <template #subtitle> Pinakaimportanteng Gawain </template>
      <template #content>
        <p>
          Competency Gap Assessment on Agri-Extension Technicians of LGU Bayawan
          City
        </p>
      </template>
      <template #footer>
        <Button icon="pi pi-check" label="Assessment Form" @click="$inertia.get('/pig/2022/assessment-form')"/>
        <Button
          icon="pi pi-times"
          label="Cancel"
          class="p-button-secondary"
          style="margin-left: 0.5em"
        />
      </template>
    </Card>
  </div>
</template>

<script>
import PigLayout from "@/Layouts/Pig.vue";
import IButton from "@/Components/Button";

// PrimeVue Components
import Button from "primevue/button";
import Card from "primevue/card";

// Layouts
import GuestLayout from "@/Layouts/Guest.vue";
import AuthLayout from "@/Layouts/Authenticated.vue";

export default {
  components: {
    Card,
    Button,
    AuthLayout,
    GuestLayout,
    PigLayout,
    IButton,
  },
  data() {
    return {
      display: true,
      displayBasic: false,
    };
  },
  methods: {
    openBasic() {
      this.displayBasic = true;
    },

    closeBasic() {
      this.displayBasic = false;
    },
  },
  mounted() {},
};
</script>