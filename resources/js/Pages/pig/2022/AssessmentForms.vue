<template>
  <!-- ################################# -->
  <guest-layout></guest-layout>
  <div class="container mx-auto px-10 mt-2 mb-10">
    <!-- container start -->
    <i-toast ref="successToast">Updated!</i-toast>

    <i-button
      @click="$inertia.get('/pig/2022/assessment-form')"
      class="btn-success"
      >Add New</i-button
    >
    <div class="w-8/12 mx-auto">
      <h1 class="mt-5 font-bold text-xl">
        Your Encoded Forms ({{ encoded_forms.length }})
      </h1>
      <table class="table-celled w-full">
        <thead>
          <tr>
            <th width="200">OPTIONS</th>
            <th>NAME</th>
            <th class="w-80">CREATED AT</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="form in encoded_forms" :key="form.id">
            <td class="text-center">
              <i-button class="btn-success" @click="edit_form(form.id)">
                Edit
              </i-button>
              <!-- <button class="btn btn-danger ms-3">Delete</button> -->
            </td>
            <td class="uppercase">{{ form.name }}</td>
            <td>{{ form.created_at }}</td>
          </tr>
        </tbody>
      </table>

      <h1 class="mt-5 font-bold text-xl">
        All Encoded Forms ({{ all_encoded_forms.length }})
      </h1>
      <table class="table-celled w-full">
        <thead>
          <tr>
            <th width="200">OPTIONS</th>
            <th>NAME</th>
            <th class="w-80">CREATED AT</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="form in all_encoded_forms" :key="form.id">
            <td class="text-center">
              <i-button class="btn-success" @click="edit_form(form.id)">
                Edit
              </i-button>
              <!-- <button class="btn btn-danger ms-3">Delete</button> -->
            </td>
            <td class="uppercase">{{ form.name }}</td>
            <td>{{ form.created_at }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- container end -->
  </div>
  <!-- ################################# -->
</template>

<script>
import GuestLayout from "@/Layouts/Guest.vue";

import { Link } from "@inertiajs/inertia-vue3";
import IButton from "@/Components/Button.vue";
import IToast from "@/Components/Toast";

export default {
  props: {
    edit_status: String,
    encoded_forms: Array,
    all_encoded_forms: Array,
  },
  components: {
    GuestLayout,
    Link,
    IButton,
    IToast
  },
  data() {
    return {};
  },
  methods: {
    edit_form(id) {
      this.$inertia.visit("/pig/2022/assessment-form/edit/" + id, {
        method: "GET",
        onSuccess: (page) => {
          // window.scrollTo(0, 0);
        },
      });
    },
  },
  mounted() {
    if (this.edit_status == "updated") {
        this.$refs.successToast.showToast();
    }
  },
};
</script>