<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','total_amount','status','shipping_add'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
