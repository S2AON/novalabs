<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'order_number' => $this->code,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'extentio_days' => $this->extention_days,
            'cost_per_day' => $this->cost_per_day,
            'subtotal' => $this->subtotal,
            'itbms' => $this->itbms,
            'total' => $this->total,
            'payment' => $this->payment,
            'cars' => $this->cars

        ];
    }
}
