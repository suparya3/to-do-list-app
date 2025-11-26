<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tanggal',
        'jam',
        'status',
        'deadline',
        'jam_mulai',
        'jam_selesai',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'deadline' => 'date',
        'status' => 'boolean',
    ];

    //relasi ke table user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
