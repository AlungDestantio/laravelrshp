<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dokter extends Model
{
    use SoftDeletes;

    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'alamat',
        'no_hp',
        'bidang_dokter',
        'jenis_kelamin',
        'iduser',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
