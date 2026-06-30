<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueueTicket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These must match the column names in your 'queue_tickets' table.
     */
    protected $fillable = [
        'qNum',
        'name',
        'phone',
        'status',
        'waitTime',
    ];
}