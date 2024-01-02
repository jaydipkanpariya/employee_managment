<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leaves';

    protected $fillable = [
        'user_id',
        'to_date',
        'from_date',
        'subject',
        'message',
        'status',
    ];
}
