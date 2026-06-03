<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    protected $fillable = ['nomor_surat', 'tanggal_mulai_pulang', 'tanggal_kembali', 'alasan_pulang', 'member_id'];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
