<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Integer;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class)->oldestOfMany();
    }


    public function carts():BelongsToMany
    {
        return $this->belongsToMany(Cart::class,'cart_product')->withPivot('quantity');
    }

    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class,'order_product')->withPivot('quantity');
    }


    public function getImageUrl():string
    {
        return $this->image ? asset($this->image->url()) : asset('img/productDefault.png');
    }
    public function priceDiscount():int
    {
//        dd("precio ".$this->price." descuento ".($this->discount/100)."% es = " .($this->price*($this->discount/100)) ." y el precio final es  ".$this->price-($this->price*($this->discount/100)));

        return $this->price-($this->price*($this->discount/100));
    }

    public function formatPrice()
    {
       return number_format((float)$this->price,0,'.','');
    }

    public function formatDiscount()
    {
        return number_format((float)$this->priceDiscount(),0,'.',',');
    }

    public function getTotalAttribute(){
        return $this->price * $this->pivot->quantity;
    }

    public function scopeActive($query)
    {
        $query->where('state','!=','inactive');
    }

    public function scopeStock($query)
    {
        $query->where('quantity','>','0');
    }
}
