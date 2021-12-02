import Model from "@/Models/Model";
import OrderStatus from "@/Models/OrderStatus";
import Client from "@/Models/Client";

export default class Order extends Model {
  defaults () {
    return {
      id: 0,
      name: '',
      status: OrderStatus,
      client: Client,
    };
  }

  formData() {
    return {
      name: this.name,
      statusId: this.status.id,
      clientId: this.client.id,
    };
  }
}
