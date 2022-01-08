<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPegawai extends Model
{
    use HasFactory;

    protected $table="gaji_pegawais";
    protected $primaryKey="id";
    protected $fillable = ['pegawai_id','total_gaji'];

    public function pegawai()
    {
        return $this->belongsTo('App\Models\Pegawai','pegawai_id','id');
    }
}
