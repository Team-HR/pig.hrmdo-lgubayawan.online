<template>
  <!-- <guest-layout v-if="!$page.props.auth.user"></guest-layout> -->
  <!-- <auth-layout v-else></auth-layout> -->
  <!-- <PigLayout> -->
  <div>
    <Card style="width: 50%; margin: auto; margin-top: 20px">
      <template #header> </template>
      <template #title> {{ `Vision Align Circle`.toUpperCase() }} </template>
      <template #subtitle> {{ `Pinakaimportanteng Gawain` }} </template>
      <template #content>
        <p>
          Competency Gap Assessment on Agri-Extension Technicians of LGU Bayawan
          City
          <br />
          <span class="font-medium"
            >Total Respondents: {{ total_respondents }}</span
          >
        </p>
      </template>
      <template #footer>
        <Button
          icon="pi pi-user-edit"
          label="Assessment Form"
          @click="$inertia.get('/pig/2022/assessment-form')"
        />
        <Button
          icon="pi pi-chart-bar"
          label="Reports (Work in Progress)"
          class="p-button-secondary"
          style="margin-left: 0.5em"
          @click="$inertia.get('/pig/2022/assessment-report')"
        />
      </template>
    </Card>
  </div>
  <!-- </PigLayout> -->
</template>

<script>
import PigLayout from "@/Layouts/Pig.vue";
import IButton from "@/Components/Button";

// PrimeVue Components
// import Button from "primevue/button";
// import Card from "primevue/card";

// Layouts
import GuestLayout from "@/Layouts/Guest.vue";
import AuthLayout from "@/Layouts/Authenticated.vue";

export default {
  props: {
    total_respondents: Number,
  },
  components: {
    // Card,
    // Button,
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