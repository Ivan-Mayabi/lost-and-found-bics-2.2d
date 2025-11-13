<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
