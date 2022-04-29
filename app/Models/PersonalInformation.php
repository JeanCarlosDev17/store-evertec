<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = ['document', 'address', 'user_id'];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
