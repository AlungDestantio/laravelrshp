<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    public $timestamps = false; // karena tabel role_user tidak ada created_at / updated_at

    protected $fillable = [
        'iduser',
        'idrole',
        'status'
    ];

    // Relasi ke Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
