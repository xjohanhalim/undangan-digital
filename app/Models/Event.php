<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
    'bride_name',
    'groom_name',
    'event_date',
    'location',
    'map_link',
    'theme',
];

}
