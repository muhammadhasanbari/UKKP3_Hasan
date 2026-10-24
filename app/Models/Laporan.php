<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'kategori',
        'lokasi',
        'tanggal_kejadian',
        'isi',
        'foto',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kejadian' => 'date',
        ];
    }

    
public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}

}