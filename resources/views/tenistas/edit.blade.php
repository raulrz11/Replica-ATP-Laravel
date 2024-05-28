@extends('main')

@section('title', 'Editar tenista')

@section('content')
    <div class="mx-2 my-2">
        @include('flash::message')
    </div>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br/>
    @endif

    <form action="{{ route('tenistas.update', $tenista->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="nombre" class="form-control-sm">Nombre</label>
                <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" value="{{ $tenista->nombre }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="puntos" class="form-control-sm">Puntos</label>
                <input class="form-control form-control-sm" id="puntos" name="puntos" type="number" value="{{ $tenista->puntos }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="pais" class="form-control-sm">Pais</label>
                <input class="form-control form-control-sm" id="pais" name="pais" type="text" value="{{ $tenista->pais }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="fecha_nacimiento" class="form-control-sm">Fecha de nacimiento</label>
                <input class="form-control form-control-sm" id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="{{ $tenista->fecha_nacimiento }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="altura" class="form-control-sm">Altura</label>
                <input class="form-control form-control-sm" id="altura" name="altura" type="number" value="{{ $tenista->altura }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="peso" class="form-control-sm">Peso</label>
                <input class="form-control form-control-sm" id="peso" name="peso" type="number"  value="{{ $tenista->peso }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="inicio_profesional" class="form-control-sm">Fecha de inicio a profesional</label>
                <input class="form-control form-control-sm" id="inicio_profesional" name="inicio_profesional" type="date" value="{{ $tenista->inicio_profesional }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="mano_buena" class="form-control-sm">Mano buena</label>
                <input class="form-control form-control-sm" id="mano_buena" name="mano_buena" type="text" value="{{ $tenista->mano_buena }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="reves" class="form-control-sm">Reves</label>
                <input class="form-control form-control-sm" id="reves" name="reves" type="text" value="{{ $tenista->reves }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="entrenador" class="form-control-sm">Entrenador</label>
                <input class="form-control form-control-sm" id="entrenador" name="entrenador" type="text" value="{{ $tenista->entrenador }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="price_money" class="form-control-sm">Price Money</label>
                <input class="form-control form-control-sm" id="price_money" name="price_money" type="number" value="{{ $tenista->price_money }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="victorias" class="form-control-sm">Victorias</label>
                <input class="form-control form-control-sm" id="victorias" name="victorias" type="number" value="{{ $tenista->victorias }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="derrotas" class="form-control-sm">Derrotas</label>
                <input class="form-control form-control-sm" id="derrotas" name="derrotas" type="number" value="{{ $tenista->derrotas }}" required style="margin-bottom: 10px">
            </div>
        </div>

        <div>
            <button class="btn" type="submit" style=" background-color: coral; color: white">Actualizar</button>
        </div>
    </form>
@endsection
