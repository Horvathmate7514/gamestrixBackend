<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function products(): BelongsToMany{
        return $this->belongsToMany(Product::class, 'order_details', 'OrderNumber', 'ProductNumber')
        ->withPivot('Quantity', 'UnitPrice');
    }
}

