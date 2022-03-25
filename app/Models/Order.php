<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'status',
    ];

    public function User():BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'order_product')->withPivot('quantity');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalAttribute(){
        return $this->products->pluck('total')->sum();
    }


}
