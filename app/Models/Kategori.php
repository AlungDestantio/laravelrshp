<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori', 'deleted_by',];
    protected $dates = ['deleted_at'];
}
