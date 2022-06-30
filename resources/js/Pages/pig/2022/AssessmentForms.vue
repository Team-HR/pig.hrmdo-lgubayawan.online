<template>
  <pig>
    <Button
      class="my-5 bg-green-500"
      label="Add New"
      @click="$inertia.get('/pig/2022/assessment-form')"
    />

    <h1>Accomplished Forms ({{ all_encoded_forms.length }})</h1>

    <DataTable
      :value="all_encoded_forms"
      class="p-datatable-sm"
      responsiveLayout="scroll"
    >
      <Column header="Edit">
        <template #body="{ data }">
          <Button
            class="p-button-sm"
            type="button"
            icon="pi pi-pencil"
            label="Edit"
            @click="edit_form(data.id)"
          />
        </template>
      </Column>
      <Column field="name" header="NAME">
        <template #body="{ data }">
          {{ data.name.toUpperCase() }}
        </template>
      </Column>
      <Column field="created_at" header="CREATED AT"></Column>
    </DataTable>
  </pig>
</template>

<script>
// primevue components
import Button from "primevue/button";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
// pig layout
import Pig from "@/Layouts/Pig.vue";

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
    Pig,
    DataTable,
    Column,
    Button,
    GuestLayout,
    Link,
    IButton,
    IToast,
  },
  data() {
    return {};
  },
  methods: {
    test(test) {
      console.log(test);
    },
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
      this.$toast.add({
        severity: "success",
        summary: "Updated!",
        detail: "Form successfully updated!",
        life: 2000,
      });
    }
  },
};
</script>