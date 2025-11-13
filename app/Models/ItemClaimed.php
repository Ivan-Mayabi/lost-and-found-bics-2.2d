<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemClaimed extends Model
{
    /** @use HasFactory<\Database\Factories\ItemClaimedFactory> */
    use HasFactory;

    // Alter the table it references
    protected $table = 'items_claimed';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item_lost()
{
    return $this->belongsTo(ItemLost::class, 'item_lost_id');
}


}
