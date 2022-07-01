<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DeliveryInfo extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'phoneNumber', 'address', 'city', 'township','delivery_fees', 'state_region'];
}