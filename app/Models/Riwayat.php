<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'username',
        // edit start
        'suhu_tubuh',
        'tensi_darah',
        'no_hp',
        'alamat',
        'jenis_kelamin',
        'umur',
        // edit end
        'hasil_diagnosa',
        'cf_max',
        'gejala_terpilih',
        'file_pdf',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
