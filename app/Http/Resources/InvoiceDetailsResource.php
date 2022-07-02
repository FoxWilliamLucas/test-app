<?php

namespace App\Http\Resources;

use App\Enums\Prices;
use App\Helpers\InvoiceHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $invoicedEvents = $this->customer->users->map->getInvoicedEvents()->flatten();
        return [
            'id'                        => $this->id,
            'start'                     => $this->start,
            'end'                       => $this->end,    
            'invoiced_events'           => $invoicedEvents,
            'customer_id'               => $this->customer_id,
            'registered_frequency'      => $this->customer->users->map(function($user){
                                return InvoiceHelper::dateBetween(
                                    $user->registered, [$this->start, $this->end]
                                );
                            })->count(),
            'activated_frequency'       => $invoicedEvents->whereNotNull('activated')->unique('user_id')->count(),
            'appointment_frequency'     => $invoicedEvents->whereNotNull('appointment')->unique('user_id')->count(),
            'total_price'               => $this->getTotalPrice(),
            'registered_price'          => Prices::REGISTRATION,
            'activated_price'           => Prices::ACTIVATION,
            'appointment_price'         => Prices::APPOINTMENT,
            'users'                     => $this->customer->users->map(function($user, $key){
                $data = InvoiceHelper::getEventsPrice($this, $user);
                return [
                    'email'             => $user->email,
                    'calculated_events' => [
                        $user->only('created'),
                        $data['activatedEvent'],
                        $data['appointmentEvent']
                    ],
                    'price'             => $data['price'],
                ];
            }),
        ];
    }
}
