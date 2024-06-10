@extends('main')

@section('title', 'Detalles del tenista')

@section('content')
    <div class="row" style="width: 100%; margin: 0; background-color: #051224; color: white">
        <div class="col-8" style="display: flex; flex-direction: column; justify-content: center; padding: 20px 40px">
            <h2 style="margin-bottom: 20px">{{ $tenista->nombre }}</h2>
            <div class="row" style="display: flex; border: 1px solid blue; border-radius: 10px; padding: 20px">
                <div class="col-1" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->ranking }}</h6>
                    <p>Ranking</p>
                </div>
                <div class="col-2" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->best_ranking }}</h6>
                    <p>Best ranking</p>
                </div>
                <div class="col-1" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->puntos }}</h6>
                    <p>Puntos</p>
                </div>
                <div class="col-3" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->win_lose }}</h6>
                    <p>W-L</p>
                </div>
                <div class="col-2" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->victorias }}</h6>
                    <p>Victorias</p>
                </div>
                <div class="col-1" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->derrotas }}</h6>
                    <p>Derrotas</p>
                </div>
                <div class="col-2" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                    <h6>{{ $tenista->price_money }}</h6>
                    <p>Price money</p>
                </div>
            </div>
        </div>
        <div class="col-4" style="display: flex; justify-content: center; align-items: center; position: relative; padding: 20px">
            <div style="position: absolute; top: 0; left: 0; background: linear-gradient(to right, #051224 0%, blue 100%); width: 100%; height: 100%; z-index: 1"></div>
            <img src="{{ $tenista->imagen_url }}" style="width: 250px; height: 250px; object-fit: cover; position: relative; z-index: 2">
        </div>
    </div>
    <div style="display: flex">
        @if(Auth::check() && Auth::user()->rol === 'ADMIN')
            <div class="icon-container">
                <form id="eliminar-tenista-form" action="{{ route('tenistas.destroy', $tenista->id) }}" method="post" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <label for="eliminar-tenista" title="Borrar" style="cursor: pointer; margin: 0">
                        <i class="fas fa-trash-alt" title="Borrar" style="background-color: red; padding: 5px; border-radius: 10px"></i>
                    </label>
                    <input id="eliminar-tenista" type="submit" style="display: none;" onclick="return confirm('¿Estás seguro de que deseas eliminar el tenista?')">
                </form>
                <a href="{{ route('tenistas.edit', $tenista->id) }}" style="text-decoration: none; color: inherit"><i class="fas fa-edit" title="Editar" style="background-color: #007bff; padding: 5px; border-radius: 10px"></i></a>
                <a href="{{ route('tenistas.image', $tenista->id) }}" style="text-decoration: none; color: inherit"><i class="fas fa-image" title="Editar imagen" style="background-color: coral; padding: 5px; border-radius: 10px"></i></a>
            </div>
        @endif
        <div class="row" style="width: 100%; margin: 0; padding: 20px">
            <div class="row" style="width: 100%">
                <div class="col-6">
                    <h4>Detalles del tenista</h4>
                </div>
                <div class="col-6" style="display: flex; justify-content: end">
                    @if(Auth::check() && Auth::user()->rol === 'USER')
                        <a href="{{ route('tenistas.pdf', $tenista->id) }}" style="text-decoration: none; color: inherit"><i class="fas fa-file-arrow-down" title="Descargar ficha del tenista" style="display: flex; justify-content: center; background-color: #cbd5e0; padding: 10px; border-radius: 100px; color: #051224; font-size: 20px; height: 40px; width: 40px"></i></a>
                    @endif
                </div>
            </div>
            <div class="row" style="width: 97%; height: 100%; margin: 0; padding: 20px">
                <div class="col-6">
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Edad</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $tenista->edad . ' (' . $tenista->fecha_nacimiento . ')'}}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Altura</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $tenista->altura . ' cm' }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Peso</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $tenista->peso . ' kg' }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Pais</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $tenista->pais }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Mano buena</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ ucwords(strtolower($tenista->mano_buena)) }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Reves</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ ucwords(str_replace('_', ' ', strtolower($tenista->reves))) }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Entrenador</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $tenista->entrenador }}</p>
                        </div>
                    </div>
                    <div class="row" style="background-color: #cbd5e0; border-radius: 20px; padding: 10px; margin: 20px">
                        <div class="col-6" style="display: flex; align-items: center">
                            <p style="margin: 0"><b>Profesional desde</b></p>
                        </div>
                        <div class="col-6" style="display: flex; align-items: center; justify-content: end">
                            <p style="margin: 0">{{ $tenista->inicio_profesional }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color: rgba(0,123,255,0.06); padding: 20px; border-top: 2px solid rgba(5,18,36,0.2)">
        <div>
            <h4>Torneos activos</h4>
        </div>
        @if(!$tenista->torneos->isEmpty())
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px">
                <div id="torneosCarousel" class="carousel slide" data-interval="false" style="width: 90%">
                    <div class="carousel-inner">
                        @foreach($tenista->torneos as $index => $torneo)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                    <a href="{{ route('torneos.show', $torneo->id) }}" class="row" style="background-color: #051224; width: 90%; padding: 20px; margin-bottom: 20px; border: 2px solid blue; border-radius: 20px; color: white; text-decoration: none">
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center">
                                            @if($torneo->categoria == 'MASTER_1000')
                                                <img src="/images/ATP_Masters_1000.png" alt="Imagen de la hola" height="50px" width="100px">
                                            @elseif($torneo->categoria == 'MASTER_500')
                                                <img src="/images/ATP_Masters_500.png" alt="Imagen de la adioa" height="70px" width="120px">
                                            @else
                                                <img src="/images/ATP_Masters_250.png" alt="Imagen de la categoria" height="50px" width="100px">
                                            @endif
                                        </div>
                                        <div class="col-5" style="display: flex; justify-content: center; align-items: center">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>{{ $torneo->nombre }}</h5>
                                                    <p style="font-size: 13px">{{ $torneo->ubicacion . '| ' . $torneo->fecha_inicio . ' / ' . $torneo->fecha_finalizacion }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center">
                                            <p>{{ ucwords(strtolower($torneo->modalidad)) }}</p>
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center">
                                            <p>{{ ucwords(str_replace('_', ' ', strtolower($torneo->categoria))) }}</p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center">
                                            <p>{{ ucwords(strtolower($torneo->superficie)) }}</p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center">
                                            <div class="row">
                                                <div class="col-12" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                    <h6>Premio</h6>
                                                    <p>{{ $torneo->premio . '$' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#torneosCarousel" role="button" data-slide="prev">
            <span style="background-color: #051224; border: 2px solid blue; border-radius: 20px; padding: 5px; display: flex; align-items: center; justify-content: center; margin-right: 110px">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 10px; height: 10px"></span>
            </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#torneosCarousel" role="button" data-slide="next">
            <span style="background-color: #051224; border: 2px solid blue; border-radius: 20px; padding: 5px; display: flex; align-items: center; justify-content: center; margin-left: 110px">
               <span class="carousel-control-next-icon" aria-hidden="true" style="width: 10px; height: 10px"></span>
            </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        @else
            <p class='lead'><em>El tenista no esta inscrito a ningun torneo actualmente.</em></p>
        @endif
        <br>
        <div>
            <h4>Ultimos torneos</h4>
        </div>
        @if(!$tenista->torneosFinalizados->isEmpty())
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 50px">
                <div id="torneosFinalizadosCarousel" class="carousel slide" data-interval="false" style="width: 90%">
                    <div class="carousel-inner">
                        @foreach($tenista->torneosFinalizados as $index => $torneo)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                    <div class="row" style="background-color: #051224; width: 90%; padding: 20px; margin-bottom: 20px; border: 2px solid blue; border-radius: 20px; color: white">
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center">
                                            @if($torneo->categoria == 'MASTER_1000')
                                                <img src="/images/ATP_Masters_1000.png" alt="Imagen de la hola" height="50px" width="100px">
                                            @elseif($torneo->categoria == 'MASTER_500')
                                                <img src="/images/ATP_Masters_500.png" alt="Imagen de la adioa" height="70px" width="120px">
                                            @else
                                                <img src="/images/ATP_Masters_250.png" alt="Imagen de la categoria" height="50px" width="100px">
                                            @endif
                                        </div>
                                        <div class="col-5" style="display: flex; justify-content: center; align-items: center">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5>{{ $torneo->nombre }}</h5>
                                                    <p style="font-size: 13px">{{ $torneo->ubicacion . '| ' . $torneo->fecha_inicio . ' / ' . $torneo->fecha_finalizacion }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center">
                                            <p>{{ ucwords(strtolower($torneo->modalidad)) }}</p>
                                        </div>
                                        <div class="col-2" style="display: flex; justify-content: center; align-items: center">
                                            <p>{{ ucwords(str_replace('_', ' ', strtolower($torneo->categoria))) }}</p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center">
                                            <p>{{ ucwords(strtolower($torneo->superficie)) }}</p>
                                        </div>
                                        <div class="col-1" style="display: flex; justify-content: center; align-items: center">
                                            <div class="row">
                                                <div class="col-12" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                    <h6>Premio</h6>
                                                    <p>{{ $torneo->premio . '$' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="display: flex; flex-direction: column; margin: 20px; border-top: 1px solid white; width: 100%; padding-top: 10px">
                                            <p><b>Ranking de finalistas:</b></p>
                                            @foreach($torneo->tenistas->sortBy('altura')->take(4) as $index => $finalista)
                                                <p style="margin: 0"><span style="color: blue">{{ $index + 1 }}</span> {{ $finalista->nombre }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#torneosFinalizadosCarousel" role="button" data-slide="prev">
            <span style="background-color: #051224; border: 2px solid blue; border-radius: 20px; padding: 5px; display: flex; align-items: center; justify-content: center; margin-right: 110px">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="width: 10px; height: 10px"></span>
            </span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#torneosFinalizadosCarousel" role="button" data-slide="next">
            <span style="background-color: #051224; border: 2px solid blue; border-radius: 20px; padding: 5px; display: flex; align-items: center; justify-content: center; margin-left: 110px">
               <span class="carousel-control-next-icon" aria-hidden="true" style="width: 10px; height: 10px"></span>
            </span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        @else
            <p class='lead'><em>El tenista no tiene torneos recientes.</em></p>
        @endif
    </div>
@endsection
