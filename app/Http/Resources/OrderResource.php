<?php

namespace App\Http\Resources;

use App\Partner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @property int        id
 * @property Partner    partner
 * @property Collection products
 * @property Collection orderProducts
 *
 * @method string getStatus()
 * @method string getLink()
 * @method string getEditLink()
 */
class OrderResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     *
     * @return object
     */
    public function toArray($request)
    {
        return (object)[
            'id'           => $this->id,
            'partner_name' => $this->whenLoaded('partner')->name,
            'cost'         => $this->orderProducts->sum('cost'),
            'status'       => $this->getStatus(),
            'link'         => $this->getLink(),
            'editLink'     => $this->getEditLink(),

            'name_order_composition' =>
                ProductResource::collection($this->whenLoaded('products'))
                    ->pluck('name')
                    ->implode(','),
        ];
    }
}
