<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemuDokter extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;
    protected $fillable = [
        'idpet',
        'idrole_user',
        'no_urut',
        'waktu_daftar',
        'status',
        'deleted_by',
    ];

    protected $dates = ['deleted_at'];

    public function pet() {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter() {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }
}
