<template>
  <div class="relative">
    <input
      class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700
        focus:bg-white
        focus:border-purple-600
        focus:outline-none
      "
      :class="className ? className : ''"
      :placeholder="placeholder"
      :value="modelValue"
      @input="updateValue"
      :required="required"
    />
    <button
      type="button"
      :hidden="modelValue ? false : true"
      @click="clear()"
      class="
        font-bold
        px-2
        text-gray-300
        hover:text-blue-500
        absolute
        right-2
        top-1.5
      "
    >
      x
    </button>
    <!-- autocomplete dropdown start -->
    <div
      ref="root"
      :hidden="datalists.length == 0"
      class="
        absolute
        bg-white
        border border-gray-200
        w-full
        text-gray-900
        max-h-80
        overflow-y-auto
        shadow-xl
      "
    >
      <button
        v-for="(item, i) in datalists"
        :key="i"
        type="button"
        class="
          text-left
          px-6
          py-2
          border-b border-gray-200
          w-full
          hover:bg-blue-500 hover:text-white
          focus:outline-none focus:ring-0 focus:bg-blue-500 focus:text-white
          transition
          duration-500
          cursor-pointer
        "
        :class="i === selectedId ? 'bg-blue-500 text-white' : ''"
        @click="choose(item.value)"
      >
        {{ item.label }}
      </button>
    </div>
  </div>
</template>

<script>
// https://stackoverflow.com/questions/5685589/scroll-to-element-only-if-not-in-view-jquery
function scrollIntoViewIfNeeded(target) {
  var rect = target.getBoundingClientRect();
  if (rect.bottom > window.innerHeight) {
    target.scrollIntoView(false);
  }
  if (rect.top < 0) {
    target.scrollIntoView();
  }
}

export default {
  props: {
    required: Boolean,
    class: String,
    placeholder: String,
    modelValue: String,
    datasets: Array,
  },
  data() {
    return {
      datalists: [],
      selectedId: 0,
    };
  },
  computed: {
    className() {
      return this.class;
    },
  },
  methods: {
    choose(val) {
      this.$emit("update:modelValue", val);
      this.datalists = [];
    },
    updateValue(event) {
      this.$emit("update:modelValue", event.target.value);
      this.filterList();
    },
    clear() {
      this.$emit("update:modelValue", "");
      this.datalists = [];
    },
    filterList() {
      var filter = this.modelValue;
      var datasets = this.datasets;
      var i,
        lists = [];
      if (!datasets) {
        return false;
      }
      // console.log(datasets);
      for (i = 0; i < datasets.length; i++) {
        // console.log(datasets[i].value);
        if (datasets[i]["value"]) {
          if (datasets[i]["value"].indexOf(filter) > -1) {
            lists.push(datasets[i]);
          }
        }
      }
      this.datalists = lists;
    },
    handleKeyDown(event) {
      // console.log(event.keyCode);
      switch (event.keyCode) {
        // In case of up arrow key, move to the last item
        case 38:
          if (this.selectedId > 0) {
            this.select(this.selectedId - 1);
          }
          event.preventDefault();
          break;
        // In case of down arrow key, move to the next item
        case 40:
          if (this.selectedId < this.datalists.length - 1) {
            this.select(this.selectedId + 1);
          }
          event.preventDefault();
          break;
        // In case of enter key pressed
        case 13:
          if (this.datalists.length > -1) {
            console.log(this.datalists[this.selectedId].value);
            this.choose(this.datalists[this.selectedId].value);
          }
          event.preventDefault();
          break;
      }
    },

    select(itemId) {
      this.selectedId = itemId;
      scrollIntoViewIfNeeded(this.$refs.root.children[itemId]);
    },
  },
  mounted() {
    window.addEventListener("keydown", this.handleKeyDown);
  },
  destroyed() {
    window.removeEventListener("keydown", this.handleKeyDown);
  },
};
</script>
