<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int status
 * @method static paginate()
 */
class Order extends Model
{
    const STATUSES = [
        0  => 'новый',
        10 => 'подтвержден',
        20 => 'завершен',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class)
            ->selectRaw(
                'order_products.*, (order_products.quantity * order_products.price) as cost'
            );
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return self::STATUSES[$this->status];
    }

    /**
     * @param string $postFix
     *
     * @return string
     */
    public function getLink(string $postFix = 'show'): string
    {
        return route("orders.{$postFix}", $this);
    }

    /**
     * @return string
     */
    public function getEditLink(): string
    {
        return $this->getLink('edit');
    }
}
