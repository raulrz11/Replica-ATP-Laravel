<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tenista extends Model
{
    use HasFactory;

    public static string $IMAGE_DEFAULT = 'https://via.placeholder.com/150';

    public static array $MANO_VALIDA=['IZQUIERDA', 'DERECHA'];
    public static array $REVES_VALIDO=['UNA_MANO', 'DOS_MANOS'];

    protected $table = 'tenistas';

    protected $casts = [
        'puntos' => 'double',
        'price_money' => 'double',
    ];

    protected $fillable = [
        'nombre',
        'ranking',
        'puntos',
        'pais',
        'fecha_nacimiento',
        'edad',
        'altura',
        'peso',
        'inicio_profesional',
        'mano_buena',
        'reves',
        'entrenador',
        'imagen',
        'price_money',
        'best_ranking',
        'victorias',
        'derrotas',
        'win_lose',

    ];

    public function torneos()
    {
        return $this->belongsToMany(Torneo::class, 'tenista_torneo', 'tenista_id', 'torneo_secondary_id', 'id', 'secondary_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->whereRaw('LOWER(nombre) LIKE ?', ["%" . strtolower($search) . "%"]);
    }
}
