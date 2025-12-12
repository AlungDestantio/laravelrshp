<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Role extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = ['nama_role', 'deleted_by',];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser')
                    ->withPivot('idrole_user', 'status');
    }

    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class, 'idrole', 'idrole');
    }
}
