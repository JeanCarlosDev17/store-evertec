<?php

namespace App\Models;

use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scopeSession($query)
    {
        $query->where('session_id', '!=', null);
    }

    public function scopeActive($query)
    {
        $query->where('state', '!=', 'inactive');
    }

    public function getCountAttribute()
    {
        return $this->products->pluck('pivot.quantity')->sum();
    }
    public function getCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at']);
    }
    public function getCreatedAtDiffAttribute()
    {
        return $this->created_at;
    }

    public function getStatusAttribute()
    {
        $state = '';
        if ($this->state == 'PENDING') {
            $state = 'Pendiente';
        } elseif ($this->state == 'APPROVED') {
            $state = 'Aprobado';
        } else {
            $state = 'Pago Fallido';
        }
        return $state;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($order) {
            $order->reference = IdGenerator::generate(['table' => 'orders', 'field'=>'reference', 'length' => 30, 'prefix' =>'ORDER-']);
        });
    }
}
