<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Status extends JsonResource
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
            'store_currency' => $this->store_currency,

            'store_buyer_name' => $this->store_buyer_name,
            'store_buyer_email' => $this->store_buyer_email,

            'crypto_address' => $this->crypto_address,
            'crypto_market_price' => $this->crypto_market_price,
            'crypto_price' => $this->crypto_price,

            'start_balance' => $this->start_balance,
            'expected_balance' => $this->crypto_expected,
            'end_balance' => $this->end_balance,

            'status_detailed' => $this->checkStatusDetailed($this->status),
            'status_basic' => $this->checkStatusBasic($this->status),

            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    private function checkStatusDetailed($status)
    {

        if ($status === 0){

            return 'pending';

        } elseif ($status === 1){

            return 'found';

        } elseif ($status === 2){

            return 'missing';

        } elseif ($status === 3){

            return 'overpaid';

        } elseif ($status === 4){

            return 'underpaid';

        } else {

            return 'unknown';

        }

    }

    private function checkStatusBasic($status)
    {

        if ($status === 0){

            return false;

        } elseif ($status === 1){

            return true;

        } elseif ($status === 2){

            return false;

        } elseif ($status === 3){

            return true;

        } elseif ($status === 4){

            return false;

        } else {

            return false;

        }

    }

}
