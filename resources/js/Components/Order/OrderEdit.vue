<script>
import OrderCreate from "@/Components/Order/OrderCreate";

export default {
  extends: OrderCreate,

  computed: {
    url () {
      return this.route('api.orders.update', this.order.id);
    },
  },
};
</script>
