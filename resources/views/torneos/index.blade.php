@php use App\Models\Torneo; @endphp
@extends('main')
@section('title', 'Lista de Torneos')
@section('content')
    <div style="padding: 20px; margin: 20px 40px">
        <div class="row" style="background-color: #051224; color: white; border: 2px solid #007bff">
            <div class="col-6" style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                <h1>Proximo Torneo</h1>
                <h3>Mutua Open Madrid</h3>
                <p>Bogota, Colombia | 10-12 Junio 2024</p>
                <button class="btn btn-primary">Comprar entradas</button>
            </div>
            <div class="col-6" style="padding: 0; position: relative">
                <img src="https://mutuamadridopen.com/filters/img/estadio-1.6affd27c.jpg" style="width: 100%; height: auto; object-fit: cover">
                <div style="position: absolute; top: 0; left: 0; background: linear-gradient(to right, #051224 0%, transparent 100%); width: 100%; height: 100%"></div>
            </div>
        </div>
    </div>
    <div style="background-color: #f1f1f1; padding: 40px; border-top-left-radius: 50px; border-top-right-radius: 50px; box-shadow: 0px -1px 10px rgba(0, 0, 0, 0.3);">
        <div class="row">
            <div class="col-3 d-flex justify-content-center align-items-center">
                <form action="{{ route('torneos.index') }}" class="mb-3" method="get">
                    @csrf
                    <div class="group">
                        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
                        <input type="search" class="inputSearch" name="search" id="search" placeholder="Buscar...">
                    </div>
                </form>
            </div>
            <div class="col-7">

            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
                @if(Auth::check() && Auth::user()->rol === 'ADMIN')
                    <a class="btn btn-success" href={{ route('productos.create') }}>Nuevo Producto</a>
                @endif
            </div>
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
            @if($torneos != null && count($torneos) > 0)
                @foreach($torneos as $torneo)
                    <a href="{{ route('torneos.show', $torneo->id) }}" class="row" style="background-color: white; width: 90%; padding: 20px; margin-bottom: 20px; border: 2px solid #051224; border-radius: 20px; color: inherit; text-decoration: none">
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
                @endforeach
            @else
                <p class='lead'><em>No se ha encontrado datos de torneos.</em></p>
            @endif
        </div>
        <div class="pagination-container" style="width: 100%; display: flex; justify-content: end; align-items: center">
            {{ $torneos->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
