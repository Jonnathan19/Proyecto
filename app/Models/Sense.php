<?php

namespace App\Models;

use App\Events\SenseCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sense extends Model
{
    protected $table = 'senses';
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'val',
        'event',
        'date',
        'name',
    ];

    protected $dispatchesEvents = [
        'created' => SenseCreated::class,
    ];
}
