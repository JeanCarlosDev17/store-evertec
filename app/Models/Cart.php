<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

//    public function user():BelongsTo
//    {
//        return $this->belongsTo(User::class,'user_id');
//    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'cart_product')->withPivot('quantity');
    }

    public function getTotalAttribute(){
        return $this->products->pluck('total')->sum();
    }

}
