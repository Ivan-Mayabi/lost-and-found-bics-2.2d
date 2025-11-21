<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
        protected $fillable=[
        'name',
        'type',
        'description'
    ];

    // Relationship
    // 1 Item has many item instances that are lost
    public function items_lost():HasMany
    {
        return $this->hasMany(ItemLost::class);
    }

}
