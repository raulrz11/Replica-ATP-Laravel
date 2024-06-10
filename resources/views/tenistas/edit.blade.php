@php use App\Models\Tenista @endphp
@extends('main')

@section('title', 'Editar tenista')

@section('content')
    <div class="mx-2 my-2">
        @include('flash::message')
    </div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" style="margin: 0">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="d-flex flex-column" action="{{ route('tenistas.update', $tenista->id) }}" method="post" style="padding: 40px">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col d-flex flex-column" style="border-left: 2px solid #007bff">
                <h5>Actualiza el tenista</h5>
                <p>(*) Campo obligatorio</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6" style="display: flex; flex-direction: column">
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="nombre" class="form-control-sm" style="color: #007bff">Nombre</label>
                        <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" value="{{ $tenista->nombre }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="puntos" class="form-control-sm" style="color: #007bff">Puntos</label>
                        <input class="form-control form-control-sm" id="puntos" name="puntos" type="number" step="any" value="{{ $tenista->puntos }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="pais" class="form-control-sm" style="color: #007bff">Pais</label>
                        <input class="form-control form-control-sm" id="pais" name="pais" type="text" value="{{ $tenista->pais }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="fecha_nacimiento" class="form-control-sm" style="color: #007bff">Fecha de nacimiento</label>
                        <input class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ $tenista->fecha_nacimiento }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="altura" class="form-control-sm" style="color: #007bff">Altura</label>
                        <input class="form-control form-control-sm" id="altura" name="altura" type="number" step="any" value="{{ $tenista->altura }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="peso" class="form-control-sm" style="color: #007bff">Peso</label>
                        <input class="form-control form-control-sm" id="peso" name="peso" type="number" step="any"  value="{{ $tenista->peso }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="inicio_profesional" class="form-control-sm" style="color: #007bff">Fecha de inicio a profesional</label>
                        <input class="form-control form-control-sm" id="inicio_profesional" name="inicio_profesional" type="date" value="{{ $tenista->inicio_profesional }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
            </div>
            <div class="col-6" style="display: flex; flex-direction: column">
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="mano_buena" class="form-control-sm" style="color: #007bff">Mano buena</label>
                        <select class="form-control form-control-sm" id="mano_buena" name="mano_buena" required style="margin-bottom: 10px; border: 1px solid #051224">
                            @foreach(Tenista::$MANO_VALIDA as $mano)
                                <option value="{{ $mano }}" {{ $tenista->mano_buena == $mano ? 'selected' : '' }}>{{ $mano }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="reves" class="form-control-sm" style="color: #007bff">Reves</label>
                        <select class="form-control form-control-sm" id="reves" name="reves" required style="margin-bottom: 10px; border: 1px solid #051224">
                            @foreach(Tenista::$REVES_VALIDO as $reves)
                                <option value="{{ $reves }}" {{ $tenista->reves == $reves ? 'selected' : '' }}>{{ $reves }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="entrenador" class="form-control-sm" style="color: #007bff">Entrenador</label>
                        <input class="form-control form-control-sm" id="entrenador" name="entrenador" type="text" value="{{ $tenista->entrenador }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="price_money" class="form-control-sm" style="color: #007bff">Price Money</label>
                        <input class="form-control form-control-sm" id="price_money" name="price_money" type="number" step="any" value="{{ $tenista->price_money }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="victorias" class="form-control-sm" style="color: #007bff">Victorias</label>
                        <input class="form-control form-control-sm" id="victorias" name="victorias" type="number" value="{{ $tenista->victorias }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="derrotas" class="form-control-sm" style="color: #007bff">Derrotas</label>
                        <input class="form-control form-control-sm" id="derrotas" name="derrotas" type="number" value="{{ $tenista->derrotas }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style=" background-color: #007bff; color: white">Actualizar</button>
        </div>
    </form>
@endsection
