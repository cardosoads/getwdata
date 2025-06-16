<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ReceivedData extends Model
{
    use HasUuids;

    protected $table = 'received_data';

    protected $fillable = [
        'user_identifier',
        'payload'
    ];



    protected $casts = [
        'payload' => 'array',
    ];
}
