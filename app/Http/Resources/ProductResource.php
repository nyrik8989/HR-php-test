<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @property string name
 * @property int    price
 * @property mixed vendor
 */
class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'   => $this->name,
            'price'  => $this->price,
            'vendor' => $this->whenLoaded('vendor')->name,
        ];
    }
}
