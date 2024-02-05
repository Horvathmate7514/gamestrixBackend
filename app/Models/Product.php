<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

   /**
    * Get the user that owns the Product
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function Category(): BelongsTo
   {
       return $this->belongsTo(Category::class, 'CategoryID');
   }

}