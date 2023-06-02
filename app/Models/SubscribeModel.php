<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeModel extends Model
{
    use HasFactory;

    protected $table = 'subscribe';

    protected $fillable = [
        'email',
    ];
}
