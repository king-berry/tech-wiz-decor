<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['order_detail_id', 'rate', 'text'];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
