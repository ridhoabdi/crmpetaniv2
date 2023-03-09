<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilepetani extends Model
{
    use HasFactory;
    protected $table = 'profilepetani';

    protected $fillable = [
        // if id is not autoincrement then add 'id'
        'id_user',
        'nama',
        'alamat',
        'nohp',
        'kabupaten',
        'pendidikan',
        'created_at',
        'updated_at',
        'id'
    ];
}
