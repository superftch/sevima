<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    protected $fillable = [
        'nik', 'alamat', 'kelurahan', 'kecamatan','kota','provinsi','tlpn','user_id','vaksin1','vaksin2','fakes','kelompok',
    ];
}
