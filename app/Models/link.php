<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class link extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'long_path',
        'smig_path',
    ];


}
