<template>
  <Head title="Orders" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <a :href="route('orders.index')">Orders</a> > Edit
        </h2>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <OrderEdit
              v-if="orderProps"
              :orderProps="orderProps"
            />
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/Button';
import OrderEdit from '@/Components/Order/OrderEdit';

export default {
  props: {
    orderId: {
      type: Number,
      required: true,
    },
  },
  components: {
    BreezeAuthenticatedLayout,
    BreezeButton,
    Head,
    OrderEdit,
  },

  data () {
    return {
      orderProps: null,
    };
  },

  created () {
    fetch(this.route('api.orders.show', this.orderId))
      .then(response => response.json())
      .then(({ data }) => {
        this.orderProps = data;
      });
  },
}
</script>
