<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Address extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'store_order_id' => $this->store_order_id,
            'store_order_price' => $this->store_order_price,
            'store_buyer_name' => $this->store_buyer_name,
            'store_buyer_email' => $this->store_buyer_email,

            'crypto_address' => $this->crypto_address,
            'crypto_market_price' => $this->crypto_market_price,
            'crypto_price' => $this->crypto_price,
            'start_balance' => $this->start_balance,
            'crypto_qr' => $this->crypto_qr,

            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
