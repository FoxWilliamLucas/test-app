<?php

namespace App\Models;

use App\Enums\Prices;
use App\Helpers\InvoiceHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'customer_id',
    ];



    // public function getInvoicedEvents(){
    //     return $this->customer->users->map->getInvoicedEvents();
    // }

    public function getTotalPrice(){
        return $this->customer->users->map(function($user){
            return InvoiceHelper::getEventsPrice($this, $user)['price'];
        })
        ->sum();
    }




    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
