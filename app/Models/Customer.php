<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name'
    ];



    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }

}
