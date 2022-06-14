<template>
  <div class="toast-container position-fixed p-3 bottom-0 end-0">
    <div
      id="liveToast"
      class="toast"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
      data-bs-delay="3000"
    >
      <div class="toast-header" :class="color ? color : ''">
        <i :class="icon"></i>
        <strong class="me-auto">{{ title ? title : "" }}</strong>
        <!-- <small>11 mins ago</small> -->
        <!-- <button
            type="button"
            class="btn-close"
            data-bs-dismiss="toast"
            aria-label="Close"
          ></button> -->
      </div>
      <div class="toast-body">
        {{ msg ? msg : "" }}
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    icon: String,
    color: String,
    title: String,
    msg: String,
  },
  methods: {
    toast_save() {
      const toastLiveExample = document.getElementById("liveToast");
      const toast = new bootstrap.Toast(toastLiveExample);
      toast.show();
    },
  },
};
</script>
