<template>
  <select
    v-bind="$attrs"
    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
    :name="name"
    :id="name"
    @change="onChange"
  >
    <option value>
      Select status
    </option>
    <option
      v-for="option in options"
      :key="option.id"
      :selected="option.is(modelValue)"
      :value="option.id"
    >
      {{ option.name }}
    </option>
  </select>
</template>

<script>
import Model from "@/Models/Model";

export default {
  props: {
    model: {
      type: Function,
      required: true,
    },

    name: {
      type: String,
      required: true,
    },

    url: {
      type: String,
      required: true,
    },

    modelValue: {
      type: Model,
      default () {
        return null;
      },
    },
  },

  emits: [
    'update:modelValue',
  ],

  data () {
    return {
      options: [],
    };
  },

  created () {
    fetch(this.url)
      .then(response => response.json())
      .then(({ data }) => {
        this.options = this.model.collection(data);
      });
  },

  methods: {
    onChange (e) {
      this.$emit('update:modelValue', this.options.find(option => option.id === parseInt(e.target.value)) || null);
    },
  },
};
</script>
