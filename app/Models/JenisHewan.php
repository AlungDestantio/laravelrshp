<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisHewan extends Model
{
    use SoftDeletes;

    protected $table = 'jenis_hewan';
    protected $primaryKey = 'idjenis_hewan';
    public $timestamps = false;
    protected $fillable = ['nama_jenis_hewan', 'deleted_by'];
    protected $dates = ['deleted_at'];
    
    public function ras()
    {
        return $this->hasMany(RasHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    }
}
