<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ItemLost extends Model
{
    /** @use HasFactory<\Database\Factories\ItemLostFactory> */
    use HasFactory;

    // Change the table it references

    protected $table='items_lost';

    protected $fillable=[
        'item_id',
        'date_lost',
        'description',
        'place_lost',
        'image_url',
        'taken',
        'date_taken',
        'user_taken_id'
    ];

    // Relationship
    // 1 item instance lost belongs to a certain item
    public function item():BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    // 1 item instance lost has many claims
    public function items_claimed():HasMany
    {
        return $this->hasMany(ItemClaimed::class);
    }

     public function claims()
    {
        return $this->hasMany(Claim::class, 'lost_item_id');
    }
}
