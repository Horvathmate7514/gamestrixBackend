<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderDetails extends Pivot
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'order_details';

    protected $primaryKey = ['OrderNumber', 'ProductNumber'];


    public function  order(): BelongsTo{
        return $this->belongsTo(Order::class, 'OrderNumber');
    }

    protected function product(): BelongsTo{
        return $this->belongsTo(Product::class, 'ProductNumber');
    }
}
