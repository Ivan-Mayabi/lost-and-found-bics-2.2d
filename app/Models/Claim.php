<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ItemLost;

class Claim extends Model
{
    /** @use HasFactory<\Database\Factories\ClaimFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lost_item_id',
        'verified'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function lostItem() {
        return $this->belongsTo(ItemLost::class, 'lost_item_id');
    }
}
