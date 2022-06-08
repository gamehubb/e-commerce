<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['voucher_code','user_id','del_name','del_address','del_city','del_township',
                            'del_phone_number','total_amount','additional_info','voucher_type','status'];

    public function order(){
        return $this->belongsTo(User::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class,'order_id','id');
    }
    public function orderitem(){
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

}
