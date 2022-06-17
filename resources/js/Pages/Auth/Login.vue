<template>
  <breeze-validation-errors class="mb-4" />

  <div v-if="status" class="alert alert-success mb-4">
    {{ status }}
  </div>


  <form @submit.prevent="submit" class="w-1/3 mx-auto mt-10 pt-10 rounded-lg shadow-xl p-10">
    <div class="flex mb-5">
      <i-label for="username" class="mt-2 mr-5 text-right">Username</i-label>
      <i-input
        type="text"
        id="username"
        class=""
        v-model="form.username"
        required
        autofocus
        autocomplete="username"
        placeholder="Username"
      />
    </div>

    <div class="flex mb-5">
      <i-label for="password" class="mt-2 mr-5 text-right">Password</i-label>
      <i-input
        type="password"
        id="password"
        class=""
        v-model="form.password"
        required
        autofocus
        autocomplete="current-password"
        placeholder="Password"
      />
    </div>

    <div class="mb-3 form-check">
      <input
        type="checkbox"
        class="mr-2 scale-150"
        id="remember"
        name="remember"
        :checked="form.remember"
      />
      <i-label class="form-check-label" for="remember">Remember me</i-label>
    </div>

    <div>
      <!-- <inertia-link
        v-if="canResetPassword"
        :href="route('password.request')"
        class="btn-primary"
        >Forgot your password?</inertia-link
      > -->
      <i-button
        type="submit"
        class="btn-primary"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Log in
      </i-button>
    </div>
  </form>
</template>

<script>
import BreezeGuestLayout from "@/Layouts/Guest";
import BreezeValidationErrors from "@/Components/ValidationErrors";

import IButton from "@/Components/Button";
import ILabel from "@/Components/Label";
import IInput from "@/Components/Input";

export default {
  layout: BreezeGuestLayout,

  components: {
    BreezeValidationErrors,
    IButton,
    ILabel,
    IInput,
  },

  props: {
    canResetPassword: Boolean,
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        username: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("login"), {
        onFinish: () => this.form.reset("password"),
      });
    },
  },
};
</script>
