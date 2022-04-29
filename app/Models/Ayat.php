<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayat extends Model
{
    use HasFactory;

    protected $fillable = ['akhir', 'penanda', 'catatan'];
    protected $appends = ['tanggal'];

    protected function tanggal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->updated_at ? $this->updated_at->format('d M Y H:i') : null,
        );
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function scopeWithNamaSurat($query)
    {
        $query->addSelect(['nama_surat' => Surat::select('nama')->whereColumn('surats.id', 'surat_id')->limit(1)]);
    }
}
