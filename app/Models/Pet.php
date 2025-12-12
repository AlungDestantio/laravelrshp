<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;
    protected $fillable = ['nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan', 'deleted_by',];

    protected $dates = ['deleted_at'];

    public function pemilik() {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function ras() {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
}
