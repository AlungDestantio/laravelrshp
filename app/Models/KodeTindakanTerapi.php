<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KodeTindakanTerapi extends Model
{
    use SoftDeletes;

    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;
    protected $fillable = ['kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis', 'deleted_by',];

    protected $dates = ['deleted_at'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }
    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }
}
