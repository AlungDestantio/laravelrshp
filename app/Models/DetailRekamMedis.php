<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRekamMedis extends Model
{
    use SoftDeletes;

    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    public $timestamps = false;

    protected $fillable = ['idrekam_medis', 'idkode_tindakan_terapi', 'detail', 'deleted_by',];

    protected $dates = ['deleted_at'];
    
    public function kodeTindakanTerapi(){
        return $this->belongsTo(KodeTindakanTerapi::class, 'idkode_tindakan_terapi', 'idkode_tindakan_terapi');
    }

    public function rekamMedis() {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis');
    }
}
