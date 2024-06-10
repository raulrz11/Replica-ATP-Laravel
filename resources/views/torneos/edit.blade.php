@php use App\Models\Torneo @endphp

@extends('main')

@section('title', 'Editar torneo')

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

    <form class="d-flex flex-column" action="{{ route('torneos.update', $torneo->id) }}" method="post" style="padding: 40px">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col d-flex flex-column" style="border-left: 2px solid #007bff">
                <h5>Actualiza el torneo</h5>
                <p>(*) Campo obligatorio</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6" style="display: flex; flex-direction: column">
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="nombre" class="form-control-sm" style="color: #007bff">Nombre</label>
                        <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" value="{{ $torneo->nombre }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="ubicacion" class="form-control-sm" style="color: #007bff">Ubicacion</label>
                        <input class="form-control form-control-sm" id="ubicacion" name="ubicacion" type="text" value="{{ $torneo->ubicacion }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="modalidad" class="form-control-sm" style="color: #007bff">Modalidad</label>
                        <select class="form-control form-control-sm" id="modalidad" name="modalidad" required style="margin-bottom: 10px; border: 1px solid #051224">
                            @foreach(Torneo::$MODALIDADES_VALIDAS as $modaliad)
                                <option value="{{ $modaliad }}" {{ $torneo->modalidad == $modaliad ? 'selected' : '' }}>{{ $modaliad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="categoria" class="form-control-sm" style="color: #007bff">Categoria</label>
                        <select class="form-control form-control-sm" id="categoria" name="categoria" required style="margin-bottom: 10px; border: 1px solid #051224">
                            @foreach(Torneo::$CATEGORIAS_VALIDAS as $categoria)
                                <option value="{{ $categoria }}" {{ $torneo->categoria == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="superficie" class="form-control-sm" style="color: #007bff">Superficie</label>
                        <select class="form-control form-control-sm" id="superficie" name="superficie" required style="margin-bottom: 10px; border: 1px solid #051224">
                            @foreach(Torneo::$SUPERFICIES_VALIDAS as $superficie)
                                <option value="{{ $superficie }}" {{ $torneo->superficie == $superficie ? 'selected' : '' }}>{{ $superficie }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6" style="display: flex; flex-direction: column">
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="entradas" class="form-control-sm" style="color: #007bff">Entradas</label>
                        <input class="form-control form-control-sm" id="entradas" name="entradas" type="number" value="{{ $torneo->entradas }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="premio" class="form-control-sm" style="color: #007bff">Premio</label>
                        <input class="form-control form-control-sm" id="premio" name="premio" type="number" value="{{ $torneo->premio }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="fecha_inicio" class="form-control-sm" style="color: #007bff">Fecha de inicio</label>
                        <input class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" type="date" value="{{ $torneo->fecha_inicio }}" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="fecha_finalizacion" class="form-control-sm" style="color: #007bff">Fecha de finalizacion</label>
                        <input class="form-control form-control-sm" id="fecha_finalizacion" name="fecha_finalizacion" type="date" value="{{ $torneo->fecha_finalizacion }}" required style="margin-bottom: 10px; border: 1px solid #051224">
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
