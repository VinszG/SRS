<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_bpj',
        'name',
        'departemen',
        'jabatan',
        'request_date',
        'deskripsi_permasalahan',
        'bukti_foto',
        'jenis',
        'status',
        'tugas'
    ];

    protected $casts = [
        'request_date' => 'date',
    ];
}