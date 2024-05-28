@extends('main')
@section('title', 'Detalles del torneo')
@section('content')
    <div class="row" style="width: 100%; margin: 0; background-color: #051224; color: white">
        <div class="col-6" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
            <h1>{{ $torneo->nombre }}</h1>
            <h5>{{ $torneo->ubicacion . ' | ' . $torneo->fecha_inicio }}</h5>
            <p>{{ ucwords(str_replace('_', ' ', strtolower($torneo->categoria))) }}</p>
        </div>
        <div class="col-6"  style="padding: 0">
            <img src="{{ $torneo->imagen }}" style="width: 100%; height: 400px; object-fit: cover">
            <div style="position: absolute; top: 0; left: 0; background: linear-gradient(to right, #051224 0%, transparent 100%); width: 100%; height: 100%"></div>
        </div>
    </div>
    <div style="display: flex">
        @if(Auth::check() && Auth::user()->rol === 'ADMIN')
            <div class="icon-container">
                <i class="fas fa-trash-alt" title="Borrar" style="background-color: red; padding: 5px; border-radius: 10px"></i> <!-- Icono para borrar -->
                <i class="fas fa-edit" title="Editar" style="background-color: #007bff; padding: 5px; border-radius: 10px"></i> <!-- Icono para editar -->
                <i class="fas fa-image" title="Editar imagen" style="background-color: coral; padding: 5px; border-radius: 10px"></i> <!-- Icono para editar imagen -->
            </div>
        @endif
        <div class="row" style="width: 100%; margin: 0; padding: 20px">
            <h4>Detalles del torneo</h4>
            <div class="row" style="width: 97%; height: 100%; margin: 0; padding: 20px">
                <div class="col-6">
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 10px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Ubicacion</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p>{{ $torneo->ubicacion }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 10px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p><b>Premio</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p>{{ $torneo->premio }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 10px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p><b>Vacantes</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p>{{ $torneo->entradas }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 10px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p><b>Modalidad</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p>{{ ucwords(strtolower($torneo->modalidad)) }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 10px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p><b>Categoria</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p>{{ ucwords(str_replace('_', ' ', strtolower($torneo->categoria))) }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 10px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p><b>Superficie</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p>{{ ucwords(strtolower($torneo->superficie)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="tenistasCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($torneo->tenistas as $index => $tenista)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="card" style="padding: 20px; width: 25%; margin: 0 auto;">
                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                            <img src="{{ $tenista->imagen }}" alt="Imagen del tenista" height="100px" width="100px">
                            <h5>{{ $tenista->nombre }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#tenistasCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#tenistasCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
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

    <form action="{{ route('torneos.inscribirTenista', $torneo->id) }}" method="post">
        @csrf
        @method('POST')
        <label for="nombre" class="form-control-sm">Nombre Tenista</label>
        <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" required style="margin-bottom: 10px">
        <button class="btn" type="submit">Inscribir</button>
    </form>
    <form action="{{ route('torneos.finalizarTorneo', $torneo->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas finalizar el torneo?')">Borrar</button>
    </form>
@endsection
