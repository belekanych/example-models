import Model from "@/Models/Model";
import Order from "@/Models/Order";

export default class Client extends Model {
  defaults () {
    return {
      id: 0,
      name: '',
      orders: [Order],
    };
  }
}
