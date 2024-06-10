@php use App\Models\Torneo @endphp

@extends('main')

@section('title', 'Crear torneo')

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

    <form class="d-flex flex-column" action="{{ route('torneos.store') }}" method="post" style="padding: 40px">
        @csrf
        <div class="row">
            <div class="col d-flex flex-column" style="border-left: 2px solid #007bff">
                <h5>Crea el torneo</h5>
                <p>(*) Campo obligatorio</p>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-6" style="display: flex; flex-direction: column">
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="nombre" class="form-control-sm" style="color: #007bff">(*)Nombre</label>
                        <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="ubicacion" class="form-control-sm" style="color: #007bff">(*)Ubicacion</label>
                        <input class="form-control form-control-sm" id="ubicacion" name="ubicacion" type="text" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="modalidad" class="form-control-sm" style="color: #007bff">(*)Modalidad</label>
                        <select class="form-control form-control-sm" id="modalidad" name="modalidad" required style="margin-bottom: 10px; border: 1px solid #051224">
                            <option></option>
                            @foreach(Torneo::$MODALIDADES_VALIDAS as $modaliad)
                                <option value="{{ $modaliad }}">{{ $modaliad }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="categoria" class="form-control-sm" style="color: #007bff">(*)Categoria</label>
                        <select class="form-control form-control-sm" id="categoria" name="categoria" required style="margin-bottom: 10px; border: 1px solid #051224">
                            <option></option>
                            @foreach(Torneo::$CATEGORIAS_VALIDAS as $categoria)
                                <option value="{{ $categoria }}">{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="superficie" class="form-control-sm" style="color: #007bff">(*)Superficie</label>
                        <select class="form-control form-control-sm" id="superficie" name="superficie" required style="margin-bottom: 10px; border: 1px solid #051224">
                            <option></option>
                            @foreach(Torneo::$SUPERFICIES_VALIDAS as $superficie)
                                <option value="{{ $superficie }}">{{ $superficie }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6" style="display: flex; flex-direction: column">
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="entradas" class="form-control-sm" style="color: #007bff">(*)Entradas</label>
                        <input class="form-control form-control-sm" id="entradas" name="entradas" type="number" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="premio" class="form-control-sm" style="color: #007bff">(*)Premio</label>
                        <input class="form-control form-control-sm" id="premio" name="premio" type="number" step="any" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="fecha_inicio" class="form-control-sm" style="color: #007bff">(*)Fecha de inicio</label>
                        <input class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" type="date" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 d-flex flex-column">
                        <label for="fecha_finalizacion" class="form-control-sm" style="color: #007bff">(*)Fecha de finalizacion</label>
                        <input class="form-control form-control-sm" id="fecha_finalizacion" name="fecha_finalizacion" type="date" required style="margin-bottom: 10px; border: 1px solid #051224">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style=" background-color: #007bff; color: white">Crear</button>
        </div>
    </form>
@endsection
