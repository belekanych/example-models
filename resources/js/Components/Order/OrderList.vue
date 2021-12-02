<template>
  <table class="w-full">
    <thead>
      <tr class="font-bold">
        <td>Id</td>
        <td>Name</td>
        <td>Client</td>
        <td>Status</td>
        <td>Actions</td>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="order in orders"
        :key="order.id"
      >
        <td>{{ order.id }}</td>
        <td>{{ order.name }}</td>
        <td>{{ order.client.name }}</td>
        <td class="py-4">
          <span
            :class="getStatusClass(order.status)"
            class="px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
          >
            {{ order.status.name }}
          </span>
        </td>
        <td>
          <a
            :href="route('orders.edit', order.id)"
            class="px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
          >
            Edit
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import Order from "@/Models/Order";
import OrderStatus from "@/Models/OrderStatus";

export default {
  data () {
    return {
      orders: [],
    };
  },

  created () {
    fetch(this.route('api.orders.index'))
      .then(response => response.json())
      .then(({ data }) => {
        this.orders = Order.collection(data);
      });
  },

  methods: {
    getStatusClass (status) {
      return {
        [OrderStatus.PENDING.id]: 'bg-red-800',
        [OrderStatus.IN_PROGRESS.id]: 'bg-blue-800',
        [OrderStatus.COMPLETED.id]: 'bg-green-800',
        [OrderStatus.CANCELLED.id]: 'bg-gray-400',
      }[status.id] || 'bg-gray-800';
    },
  },
};
</script>
