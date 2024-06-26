<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'seller_id',
        'sold_at',
        'status',
        'total_amount'
    ];

    protected $casts = [
      'status' => Status::class
    ];

    public function client():BelongsTo
    {
     return $this->Belongsto(Client::class);
    }

    public function seller():BelongsTo
    {
     return $this->Belongsto(Seller::class);
    }
}
