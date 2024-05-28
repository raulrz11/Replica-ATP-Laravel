@extends('main')

@section('title', 'Editar torneo')

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

    <form action="{{ route('torneos.update', $torneo->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="nombre" class="form-control-sm">Nombre</label>
                <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" value="{{ $torneo->nombre }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="ubicacion" class="form-control-sm">Ubicacion</label>
                <input class="form-control form-control-sm" id="ubicacion" name="ubicacion" type="text" value="{{ $torneo->ubicacion }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="modalidad" class="form-control-sm">Modalidad</label>
                <input class="form-control form-control-sm" id="modalidad" name="modalidad" type="text" value="{{ $torneo->modalidad }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="categoria" class="form-control-sm">Categoria</label>
                <input class="form-control form-control-sm" id="categoria" name="categoria" type="text" value="{{ $torneo->categoria }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="superficie" class="form-control-sm">Superficie</label>
                <input class="form-control form-control-sm" id="superficie" name="superficie" type="text" value="{{ $torneo->superficie }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="entradas" class="form-control-sm">Entradas</label>
                <input class="form-control form-control-sm" id="entradas" name="entradas" type="number" value="{{ $torneo->entradas }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="premio" class="form-control-sm">Premio</label>
                <input class="form-control form-control-sm" id="premio" name="premio" type="number" value="{{ $torneo->premio }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="fecha_inicio" class="form-control-sm">Fecha de inicio</label>
                <input class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" type="date" value="{{ $torneo->fecha_inicio }}" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="fecha_finalizacion" class="form-control-sm">Fecha de finalizacion</label>
                <input class="form-control form-control-sm" id="fecha_finalizacion" name="fecha_finalizacion" type="date" value="{{ $torneo->fecha_finalizacion }}" required style="margin-bottom: 10px">
            </div>
        </div>

        <div>
            <button class="btn" type="submit" style=" background-color: coral; color: white">Actualizar</button>
        </div>
    </form>
@endsection
