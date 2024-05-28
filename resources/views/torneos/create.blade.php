@php use App\Models\Torneo @endphp

@extends('main')

@section('title', 'Crear torneo')

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

    <form action="{{ route('torneos.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="nombre" class="form-control-sm">(*)Nombre</label>
                <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="ubicacion" class="form-control-sm">(*)Ubicacion</label>
                <input class="form-control form-control-sm" id="ubicacion" name="ubicacion" type="text" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="modalidad" class="form-control-sm">(*)Modalidad</label>
                <select class="form-control form-control-sm" id="modalidad" name="modalidad" required style="margin-bottom: 10px">
                    @foreach(Torneo::$MODALIDADES_VALIDAS as $modaliad)
                        <option value="{{ $modaliad }}">{{ $modaliad }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="categoria" class="form-control-sm">(*)Categoria</label>
                <select class="form-control form-control-sm" id="categoria" name="categoria" required style="margin-bottom: 10px">
                    @foreach(Torneo::$CATEGORIAS_VALIDAS as $categoria)
                        <option value="{{ $categoria }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="superficie" class="form-control-sm">(*)Superficie</label>
                <select class="form-control form-control-sm" id="superficie" name="superficie" required style="margin-bottom: 10px">
                    @foreach(Torneo::$SUPERFICIES_VALIDAS as $superficie)
                        <option value="{{ $superficie }}">{{ $superficie }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="entradas" class="form-control-sm">(*)Entradas</label>
                <input class="form-control form-control-sm" id="entradas" name="entradas" type="number" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="premio" class="form-control-sm">(*)Premio</label>
                <input class="form-control form-control-sm" id="premio" name="premio" type="number" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="fecha_inicio" class="form-control-sm">(*)Fecha de inicio</label>
                <input class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" type="date" required style="margin-bottom: 10px">
            </div>
        </div>
        <div class="row">
            <div class="col-4 d-flex flex-column">
                <label for="fecha_finalizacion" class="form-control-sm">(*)Fecha de finalizacion</label>
                <input class="form-control form-control-sm" id="fecha_finalizacion" name="fecha_finalizacion" type="date" required style="margin-bottom: 10px">
            </div>
        </div>

        <div>
            <button class="btn" type="submit" style=" background-color: coral; color: white">Crear</button>
        </div>
    </form>
@endsection
