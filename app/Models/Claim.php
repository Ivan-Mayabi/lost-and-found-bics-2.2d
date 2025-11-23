<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ItemLost;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Claim extends Model
{
    /** @use HasFactory<\Database\Factories\ClaimFactory> */
    use HasFactory;
    protected $table='items_claimed';

    protected $fillable = [
        'user_id',
        'lost_item_id',
        'verified'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lostItem(): BelongsTo {
        return $this->belongsTo(ItemLost::class, 'item_lost_id');
    }
}
