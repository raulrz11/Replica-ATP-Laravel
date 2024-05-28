<?php

namespace App\Http\Requests;

use App\Models\Tenista;
use Illuminate\Foundation\Http\FormRequest;

class TenistasRequest extends FormRequest
{

    public function rules(): array{
        return [
            'nombre' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:30'],
            'puntos' => ['required', 'numeric', 'min:0.1'],
            'pais' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:30'],
            'fecha_nacimiento' => ['required', 'date', 'before_or_equal:today'],
            'altura' => ['required', 'numeric', 'min:0.1'],
            'peso' => ['required', 'numeric', 'min:0.1'],
            'inicio_profesional' => ['required', 'date', 'before_or_equal:today'],
            'mano_buena' => ['required', 'string', 'in:'. implode(',', Tenista::$MANO_VALIDA)],
            'reves' => ['required', 'string', 'in:'. implode(',', Tenista::$REVES_VALIDO)],
            'entrenador' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'min:3', 'max:30'],
            'price_money' => ['required', 'numeric', 'min:0.1'],
            'victorias' => ['required', 'integer', 'min:1'],
            'derrotas' => ['required', 'integer', 'min:1'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
