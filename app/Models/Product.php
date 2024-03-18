<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];


   /**
    * Get the user that owns the Product
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function Category(): BelongsTo
   {
       return $this->belongsTo(Category::class, 'CategoryID');
   }

   public function order(): BelongsToMany{
        return $this->belongsToMany(Order::class, 'order_details', 'ProductNumber', 'OrderNumber')
        ->withPivot('QuantityOrdered', 'QuotedPrice');
   }



}