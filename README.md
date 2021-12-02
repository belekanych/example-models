## Concept
The idea is to use classes on the frontend with the same structure and approaches as it is already done in the Laravel framework.

## Benefits
* The same model structure may be used everywhere instead of working with different objects on different pages.
* Attributes are automatically filled with default values.
* Related models are used in the same way on different pages.
* Constants related to a model are defined inside the model.
* Logic may be encapsulated inside models.

## Usage
Create a separate class inside a separate file for each model. Models should extend the base model:
```javascript
import Model from "@/Models/Model";

export default class Order extends Model {
    //
}
```
### Attributes
To define attributes use the `default` method:
```javascript
export default class Order extends Model {
  defaults() {
    return {
      id: 0,
      name: '',
    };
  }
}
```
The model instance will be automatically filled with these values. You may use all JavaScript types.

### Relations
If you want to define a relation, specify it in the `default` method using the already created model class:
```javascript
import Model from "@/Models/Model";
import OrderStatus from "@/Models/OrderStatus";

export default class Order extends Model {
  defaults() {
    return {
      status: OrderStatus,
    };
  }
}
```

To define a `one-to-many` or a `many-to-many` relation, put a model inside an array:
```javascript
import Model from "@/Models/Model";
import Order from "@/Models/Order";

export default class Client extends Model {
  defaults() {
    return {
      orders: [Order],
    };
  }
}
```

### Attributes mapping (resource + model)
To automatically fill the model with correct values from the backend, the same structure should be used in resources:
```php
namespace App\Http\Resources;

class OrderResource extends Resource
{
    public function toArray($request): array
    {
        return [
            'id'     => $this->resource->id,
            'name'   => $this->resource->name,
            'client' => $this->resourceWhenLoaded('client', ClientResource::class),
            'status' => $this->resourceWhenLoaded('status', OrderStatusResource::class),
        ];
    }
}
```

Each resource should extend the base resource to use helpers (e.g. `resourceWhenLoaded`):
```php
namespace App\Http\Resources;

class OrderResource extends Resource
{
    //
}
```

If you do not need to use a relation, you should not load it from the database. A resource will skip the relation, `null` will be set in the response and in the model.
#### PHP
```php
return OrderResource::collection(
    Order::with(['status'])->get()
);
```
#### JSON
```json
{
    "data": [
        {
            "id": 1,
            "name": "Test order",
            "client": null,
            "status": {
                "id": 1,
                "name": "Pending"
            }
        }
    ]
}
```
#### JS Model structure
```
order: Order
    id: 1
    name: "Test order"
    client: null
    status: OrderStatus
        id: 1
        name: "Pending"
```

### Constants
Sometimes there is a need to use predefined values. This is how a constant may be defined:
```javascript
export default class OrderStatus extends Model {
  static get PENDING() {
    return new this({
      id: 1,
      name: 'Pending',
    });
  }
}
```

### Helpers
To avoid using magic numbers and encapsulate logic inside a model, you may define helpers inside the model:
```javascript
export default class OrderStatus extends Model {
  isPending() {
    return this.is(OrderStatus.PENDING);
  }
}
```

These helpers may be used everywhere you need:
```javascript
export default {
  computed: {
    hidden() {
      return this.order.status.isPending();
    }
  },
}
```

### Utils
You may also use already created helpers.<br />

To create a model:
```javascript
this.order = Order.make(data);
```

To create a collection of models:
```javascript
this.orders = Order.collection(data);
```

To check the model is the same:
```javascript
return this.order.is(order);
```

## How to run the example
If you would like to run the example to have some play with the code, clone the repository and execute the command ([Laravel Sail](https://laravel.com/docs/8.x/sail) is used):
```shell
vendor/bin/sail up -d
```
To build the frontend:
```shell
vendor/bin/sail npm run watch
```
To stop running it:
```shell
vendor/bin/sail stop
```

## Contacts
If you have any comments or questions, do not hesitate to contact me:
* Email: <yuriy.belekanych@gmail.com>
* Telegram: [@yuriybelekanych](https://t.me/yuriybelekanych)
