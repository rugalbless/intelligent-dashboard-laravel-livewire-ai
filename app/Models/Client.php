<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'users_id'
    ];

    public function address():HasOne
    {
        return $this->hasOne(Address::class);
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function sales(): HasMany{
        return $this->hasMany(Sale::class);
    }

}
