<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getTotalAttribute()
    {
        return $this->products->pluck('total')->sum();
    }

    public function getCountAttribute()
    {
        return $this->products->pluck('pivot.quantity')->sum();
    }
    public function getCreatedAtAttribute( )
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'] );

    }
    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at;
    }




}
