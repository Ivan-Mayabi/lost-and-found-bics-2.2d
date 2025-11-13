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
}
