import Model from "@/Models/Model";

export default class OrderStatus extends Model {
  defaults() {
    return {
      id: 0,
      name: '',
    };
  }

  static get PENDING() {
    return new this({
      id: 1,
      name: 'Pending',
    });
  }

  static get IN_PROGRESS() {
    return new this({
      id: 2,
      name: 'In progress',
    });
  }

  static get COMPLETED() {
    return new this({
      id: 3,
      name: 'Completed',
    });
  }

  static get CANCELLED() {
    return new this({
      id: 4,
      name: 'Cancelled',
    });
  }

  isPending() {
    return this.is(OrderStatus.PENDING);
  }

  isInProgress() {
    return this.is(OrderStatus.IN_PROGRESS);
  }

  isCompleted() {
    return this.is(OrderStatus.COMPLETED);
  }

  isCancelled() {
    return this.is(OrderStatus.CANCELLED);
  }
}
