<?php

namespace App\Http\Resources;

use App\Enums\Prices;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'invoice_id'        => $this->customer_id,
            'customer_id'       => $this->customer_id,
            'start'             => $this->start,
            'end'               => $this->end,
        ];
    }
}
