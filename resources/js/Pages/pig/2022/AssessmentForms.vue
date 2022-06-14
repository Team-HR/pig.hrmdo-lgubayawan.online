<template>
  <div class="position-absolute top-0 min-vh-100 min-vw-100 bg-light">
    <!-- ################################# -->

    <div class="container mt-5">
      <!-- container start -->
      <Link class="btn btn-primary" href="/pig/2022/assessment-form">
        <i class="bi bi-arrow-90deg-left"></i> Go Back/Add New
      </Link>

      <h1 class="mt-3">Your Encoded Forms ({{ encoded_forms.length }})</h1>
      <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th width="200">OPTIONS</th>
            <th>NAME</th>
            <th>CREATED AT</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="form in encoded_forms" :key="form.id">
            <td>
              <button class="btn btn-success" @click="edit_form(form.id)">
                Edit
              </button>
              <!-- <button class="btn btn-danger ms-3">Delete</button> -->
            </td>
            <td>{{ form.name }}</td>
            <td>{{ form.created_at }}</td>
          </tr>
        </tbody>
      </table>

      <h1 class="mt-3">All Encoded Forms ({{ all_encoded_forms.length }})</h1>
      <table class="table table-sm table-striped">
        <thead>
          <tr>
            <th width="200">OPTIONS</th>
            <th>NAME</th>
            <th>CREATED AT</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="form in all_encoded_forms" :key="form.id">
            <td>
              <button class="btn btn-success" @click="edit_form(form.id)">
                Edit
              </button>
              <!-- <button class="btn btn-danger ms-3">Delete</button> -->
            </td>
            <td>{{ form.name }}</td>
            <td>{{ form.created_at }}</td>
          </tr>
        </tbody>
      </table>
      <!-- container end -->
    </div>
    <!-- toast start -->
    <AppToast
      ref="successToast"
      color="text-white bg-warning"
      icon="bi bi-check-circle me-2"
      title="Form Updated!"
      msg="Form updated successfully!"
    />
    <!-- toast end -->
    <!-- ################################# -->
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import AppToast from "../../../Components/Toast.vue";

export default {
  props: {
    edit_status: String,
    encoded_forms: Array,
    all_encoded_forms: Array,
  },
  components: {
    Link,
    AppToast,
  },
  data() {
    return {};
  },
  methods: {
    edit_form(id) {
      this.$inertia.visit("/pig/2022/assessment-form/edit/" + id, {
        method: "GET",
        preserveScroll: false,
        onSuccess: (page) => {
          window.scrollTo(0, 0);
        },
      });
    },
  },
  mounted() {
    if (this.edit_status == "updated") {
      this.$refs.successToast.toast_save();
    }
  },
};
</script>