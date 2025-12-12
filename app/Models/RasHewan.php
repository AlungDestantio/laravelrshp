<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RasHewan extends Model
{
    use SoftDeletes;

    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    public $timestamps = false;
    protected $fillable = ['nama_ras', 'idjenis_hewan', 'deleted_by',];

    protected $dates = ['deleted_at'];

    public function jenis() {
        return $this->belongsTo(JenisHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
