<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Torneo extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public static string $IMAGE_DEFAULT = 'https://via.placeholder.com/150';

    public static array $MODALIDADES_VALIDAS=['INDIVIDUALES', 'DOBLES','INDIVIDUALES/DOBLES'];
    public static array $CATEGORIAS_VALIDAS=['MASTER_1000', 'MASTER_500','MASTER_250'];
    public static array $SUPERFICIES_VALIDAS=['HIERBA', 'ARCILLA','ASFALTO'];

    protected $table = 'torneos';

    protected  $fillable = [
        'nombre',
        'ubicacion',
        'modalidad',
        'categoria',
        'superficie',
        'entradas',
        'premio',
        'fecha_inicio',
        'fecha_finalizacion',
        'imagen'
    ];

    //Revisar
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($torneo) {
            $torneo->id = Str::uuid();

        });
    }

    public function tenistas()
    {
        return $this->belongsToMany(Tenista::class, 'tenista_torneo', 'torneo_secondary_id', 'tenista_id', 'secondary_id', 'id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($search) . "%"]);
    }

    public function getImagenUrlAttribute()
    {
        if (filter_var($this->imagen, FILTER_VALIDATE_URL)) {
            return $this->imagen;
        }

        return asset('storage/' . $this->imagen);
    }
}
