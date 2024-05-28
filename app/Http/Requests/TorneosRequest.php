<?php

namespace App\Http\Requests;

use App\Models\Torneo;
use Illuminate\Foundation\Http\FormRequest;

class TorneosRequest extends FormRequest
{
    public function rules(): array{
        return [
            'nombre' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:30'],
            'ubicacion' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:30'],
            'modalidad' => ['required', 'string', 'in:'. implode(',', Torneo::$MODALIDADES_VALIDAS)],
            'categoria' => ['required', 'string', 'in:'. implode(',', Torneo::$CATEGORIAS_VALIDAS)],
            'superficie' => ['required', 'string', 'in:'. implode(',', Torneo::$SUPERFICIES_VALIDAS)],
            'entradas' => ['required', 'integer', 'min:1'],
            'premio' => ['required', 'numeric', 'min:0.1'],
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
            'fecha_finalizacion' => ['required', 'date', 'after_or_equal:fecha_inicio'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
