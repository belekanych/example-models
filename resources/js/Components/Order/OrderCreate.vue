<template>
  <BreezeValidationErrors class="mb-4" />

  <form
    class="flex justify-center"
    @submit.prevent="submit"
  >
    <div class="w-1/3 flex flex-col items-end">
      <div class="w-full">
        <BreezeLabel
          for="name"
          value="Name"
        />
        <BreezeInput
          v-model="order.name"
          id="name"
          type="text"
          class="mt-1 mb-4 block w-full"
          required
          autofocus
          :autocomplete="false"
        />
      </div>

      <div class="w-full">
        <BreezeLabel
          for="client"
          value="Client"
        />
        <SelectField
          v-model="order.client"
          class="mt-1 mb-4 block w-full"
          name="client"
          required
          :model="models.Client"
          :url="route('api.clients.index')"
        />
      </div>

      <div class="w-full">
        <BreezeLabel
          for="status"
          value="Status"
        />
        <SelectField
          v-model="order.status"
          class="mt-1 mb-4 block w-full"
          name="status"
          required
          :model="models.OrderStatus"
          :url="route('api.orders.statuses.index')"
        />
      </div>

      <BreezeButton
        class="mt-4"
        :class="{ 'opacity-25': processing }"
        :disabled="processing"
      >
        Save
      </BreezeButton>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import Order from "@/Models/Order";
import OrderStatus from "@/Models/OrderStatus";
import Client from "@/Models/Client";
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import SelectField from "@/Components/SelectField";

export default {
  props: {
    orderProps: {
      type: Object,
      default () {
        return {};
      },
    },
  },

  components: {
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    SelectField,
  },

  data () {
    return {
      order: new Order(this.orderProps),
      processing: false,
    };
  },

  computed: {
    models () {
      return {
        Client,
        OrderStatus,
      };
    },

    url () {
      return this.route('api.orders.store');
    },
  },

  methods: {
    submit () {
      this.processing = true;

      return axios.post(this.url, this.order.formData(), {
        headers: {
          'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
      }).then(() => {
        window.location.href = this.route('orders.index');
      });
    },
  },
};
</script>
