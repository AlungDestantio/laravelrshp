<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perawat extends Model
{
    use SoftDeletes;

    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    public $timestamps = false;

    protected $fillable = [
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'pendidikan',
        'iduser',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
