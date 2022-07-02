<?php
namespace App\Helpers;

use App\Enums\Prices;


class InvoiceHelper
{
    public static function dateBetween($date, $between){
        return $date >= $between[0] && $date <= $between[1];
    }


    public static function getEventsPrice($invoice, $user){
        $price = 0;
        if(self::dateBetween($user->registered, [$invoice->start, $invoice->end]))
            $price = Prices::REGISTRATION;
        $userEvents =  $user->getInvoicedEvents();
        
        $activatedEvent = $userEvents->whereNotNull('activated')->first();
        if($activatedEvent && self::dateBetween($activatedEvent->activated, [$invoice->start, $invoice->end])){
            if($user->registered < $invoice->start) $price = (Prices::ACTIVATION - Prices::REGISTRATION);
            else $price = Prices::ACTIVATION;
        }
        
        $appointmentEvent = $userEvents->whereNotNull('appointment')->first();
        if($appointmentEvent && self::dateBetween($appointmentEvent->appointment, [$invoice->start, $invoice->end]))
            $price = Prices::APPOINTMENT;
        
        return [
            'price' => $price,
            'activatedEvent' => $activatedEvent,
            'appointmentEvent' => $appointmentEvent
        ];
    }
}