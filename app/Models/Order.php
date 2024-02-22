<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['OrderNumber', 'OrderDate', 'ShipDate', 'CustomerID' ];
    public $timestamps = false;

    protected $primaryKey = 'OrderNumber';
    protected $table = 'orders';

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'CustomerID');
    }
}

