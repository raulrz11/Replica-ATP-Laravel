@extends('main')
@section('title', 'Detalles del torneo')
@section('content')
    @if ($errors->any() || session('error'))
        <div class="alert alert-danger alert-dismissible" style="margin: 0">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @if(session('error'))
                    <li>{{ session('error') }}</li>
                @endif
            </ul>
        </div>
    @endif

    <div class="row" style="width: 100%; margin: 0; background-color: #051224; color: white">
        <div class="col-6" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
            <h1>{{ $torneo->nombre }}</h1>
            <h5>{{ $torneo->ubicacion . ' | ' . $torneo->fecha_inicio }}</h5>
            <p>{{ ucwords(str_replace('_', ' ', strtolower($torneo->categoria))) }}</p>
        </div>
        <div class="col-6"  style="padding: 0">
            <img src="{{ $torneo->imagen_url }}" style="width: 100%; height: 400px; object-fit: cover">
            <div style="position: absolute; top: 0; left: 0; background: linear-gradient(to right, #051224 0%, transparent 100%); width: 100%; height: 100%"></div>
        </div>
    </div>
    <div style="display: flex">
        @if(Auth::check() && Auth::user()->rol === 'ADMIN')
            <div class="icon-container">
                <form id="eliminar-torneo-form" action="{{ route('torneos.destroy', $torneo->id) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <label for="eliminar-torneo" title="Borrar" style="cursor: pointer; margin: 0">
                        <i class="fas fa-trash-alt" title="Borrar" style="background-color: red; padding: 5px; border-radius: 10px"></i>
                    </label>
                    <input id="eliminar-torneo" type="submit" style="display: none;" onclick="return confirm('¿Estás seguro de que deseas eliminar el torneo?')">
                </form>
                <a href="{{ route('torneos.edit', $torneo->id) }}" style="text-decoration: none; color: inherit"><i class="fas fa-edit" title="Editar" style="background-color: #007bff; padding: 5px; border-radius: 10px"></i></a>
                <a href="{{ route('torneos.image', $torneo->id) }}" style="text-decoration: none; color: inherit"><i class="fas fa-image" title="Editar imagen" style="background-color: coral; padding: 5px; border-radius: 10px"></i></a>
                <a href="#inscribirTenistaModal" style="text-decoration: none; color: inherit"><i class="fas fa-user-plus" title="Inscribir tenista" style="background-color: green; padding: 5px; border-radius: 15px"></i></a>
                @if(!$torneo->tenistas->isEmpty())
                    <form id="finalizar-torneo-form" action="{{ route('torneos.finalizarTorneo', $torneo->id) }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <label for="finalizar-torneo" title="Finalizar torneo" style="cursor: pointer;">
                            <i class="fas fa-trophy" style="color: white; background-color: black; padding: 7px; border-radius: 15px"></i>
                        </label>
                        <input id="finalizar-torneo" type="submit" style="display: none;" onclick="return confirm('¿Estás seguro de que deseas finalizar el torneo?')">
                    </form>
                @endif
            </div>
        @endif
        <div class="row" style="width: 100%; margin: 0; padding: 20px">
            <h4>Detalles del torneo</h4>
            <div class="row" style="width: 97%; height: 100%; margin: 0; padding: 20px">
                <div class="col-6">
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Ubicacion</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $torneo->ubicacion }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Premio</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $torneo->premio }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Vacantes</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $torneo->entradas }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Modalidad</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ ucwords(strtolower($torneo->modalidad)) }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Categoria</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ ucwords(str_replace('_', ' ', strtolower($torneo->categoria))) }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Superficie</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ ucwords(strtolower($torneo->superficie)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color: rgba(0,123,255,0.06); padding: 20px; border-top: 2px solid rgba(5,18,36,0.2)">
        <div>
            <h4>Participantes</h4>
        </div>
        @if(!$torneo->tenistas->isEmpty())
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px">
                <div id="tenistasCarousel" class="carousel slide" data-interval="false" style="width: 60%">
                    <div class="carousel-inner">
                        @foreach($torneo->tenistas->chunk(3) as $index => $chunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="d-flex justify-content-center">
                                    @foreach($chunk as $tenista)
                                        <a href="{{ route('tenistas.show', $tenista->id) }}" class="card mx-2" style="padding: 20px; width: 25%; border: 2px solid blue; background-color: #051224; color: white; text-decoration: none">
                                            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                <img src="{{ $tenista->imagen }}" alt="Imagen del tenista" height="100px" width="100px" style="margin-bottom: 10px">
                                                <h5>{{ $tenista->nombre }}</h5>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#tenistasCarousel" role="button" data-slide="prev">
            <span style="background-color: #051224; border: 2px solid blue; border-radius: 20px; padding: 5px; display: flex; align-items: center; justify-content: center">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 10px; height: 10px"></span>
            </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#tenistasCarousel" role="button" data-slide="next">
            <span style="background-color: #051224; border: 2px solid blue; border-radius: 20px; padding: 5px; display: flex; align-items: center; justify-content: center">
               <span class="carousel-control-next-icon" aria-hidden="true" style="width: 10px; height: 10px"></span>
            </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        @else
            <p class='lead'><em>No hay tenistas inscritos al torneo.</em></p>
        @endif
    </div>

    <!-- Modal inscribir tenista -->
    <div id="inscribirTenistaModal" class="modal">
        <div class="modal-content">
            <div style="display: flex; justify-content: end">
                <a href="#" class="close" style="margin: 5px">&times;</a>
            </div>
            <form action="{{ route('torneos.inscribirTenista', $torneo->id) }}" method="post" style="display: flex; margin: 20px">
                @csrf
                @method('POST')
                <input class="form-control form-control-sm" id="nombre" name="nombre" type="text" placeholder="Nombre del tenista..." required>
                <button class="btn btn-primary btn-sm" type="submit">Inscribir</button>
            </form>
        </div>
    </div>
@endsection
