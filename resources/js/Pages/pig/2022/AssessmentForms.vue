<template>
  <div class="position-absolute top-0 min-vh-100 min-vw-100 bg-light">
    <!-- ################################# -->

    <div class="container mt-5">
      <!-- container start -->
      <Link href="/pig/2022/assessment-form">
        <a class="btn btn-primary">Go Back/Add New</a>
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
              <!-- <Link :href="`/pig/2022/assessment-form/edit/${form.id}`">
                <a class="btn btn-success"> Edit </a>
              </Link> -->
              <button
                class="btn btn-success"
                @click.prevent="edit_form(form.id)"
              >
                Edit
              </button>

              <button class="btn btn-danger ms-3">Delete</button>
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
              <button class="btn btn-success">Edit</button>
              <button class="btn btn-danger ms-3">Delete</button>
            </td>
            <td>{{ form.name }}</td>
            <td>{{ form.created_at }}</td>
          </tr>
        </tbody>
      </table>
      <!-- container end -->
    </div>

    <!-- ################################# -->
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
// import Inertia from "@inertiajs/inertia";
export default {
  props: {
    encoded_forms: Array,
    all_encoded_forms: Array,
  },
  components: {
    Link,
  },
  data() {
    return {};
  },
  methods: {
    edit_form(id) {
      this.$inertia.visit("/pig/2022/assessment-form/edit/" + id);
    },
  },
};
</script>