<?php

namespace App\Models;

use Core\Model\BaseModel;

class Order extends BaseModel
{
    protected static string $table = 'orders';

    protected $fillable = [
        'address'
    ];

    public function products()
    {
        return OrderItems::sql("SELECT * FROM products
            RIGHT JOIN order_items ON order_items.product_id = products.id
            WHERE order_id = $this->id");
    }

    public function user()
    {
        return User::find($this->user_id);
    }
}
