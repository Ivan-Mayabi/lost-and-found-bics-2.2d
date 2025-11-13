<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLost extends Model
{
    /** @use HasFactory<\Database\Factories\ItemLostFactory> */
    use HasFactory;

    // Change the table it references
    protected $table = 'items_lost';
}
