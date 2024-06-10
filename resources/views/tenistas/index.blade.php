@php use App\Models\Tenista; @endphp
@extends('main')
@section('title', 'Lista de Tenistas')
@section('content')
    <div class="row" style="display: flex; justify-content: center; align-items: center; background-color: #051224; padding: 50px; margin: 0; width: 100%; box-shadow: 0px 30px 20px -20px blue inset">
        <div class="col-7" style="display: flex; justify-content: center; align-items: center">
            <div class="row" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: white">
                <h1 style="color: #007bff">TOP 3</h1>
                <br>
                <div class="col-12" style="display: flex; justify-content: center; align-items: center">
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        @foreach($tenistasTop->take(2) as $tenistaTop) @endforeach
                        <h2 style="color: silver">{{ $tenistaTop->ranking }}</h2>
                        <img src="{{ $tenistaTop->imagen_url }}" width="100px" height="100px" style="margin: 10px">
                        <h5>{{ $tenistaTop->nombre }}</h5>
                    </div>
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        @foreach($tenistasTop->take(1) as $tenistaTop) @endforeach
                        <h1 style="color: gold">{{ $tenistaTop->ranking }}</h1>
                        <img src="{{ $tenistaTop->imagen_url }}" width="150px" height="150px" style="margin: 10px">
                        <h4>{{ $tenistaTop->nombre }}</h4>
                    </div>
                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                        @foreach($tenistasTop->take(3) as $tenistaTop) @endforeach
                        <h3 style="color: saddlebrown">{{ $tenistaTop->ranking }}</h3>
                        <img src="{{ $tenistaTop->imagen_url }}" width="100px" height="100px" style="margin: 10px">
                        <h6>{{ $tenistaTop->nombre }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3" style="color: white">
            <h4>TOP 10</h4>
            @if($tenistasTop != null && count($tenistasTop) > 0)
                <table class="table" style="color: white;">
                    <thead>
                    <tr>
                        <th class="th-top10">Ranking</th>
                        <th class="th-top10">Nombre</th>
                    </tr>
                    </thead>
                </table>
                <div style="overflow: scroll; max-height: 200px; scrollbar-width: none">
                    <table class="table" style="color: white">
                        <tbody>
                        @foreach($tenistasTop->take(10) as $tenistaTop)
                            <tr>
                                <td>{{$tenistaTop -> ranking}}</td>
                                <td>{{$tenistaTop -> nombre}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class='lead'><em>No se ha encontrado datos de tenistas.</em></p>
            @endif
        </div>
    </div>
    <div style="padding: 40px">
        <div class="row">
            <div class="col-3 d-flex justify-content-center align-items-center">
                <form action="{{ route('tenistas.index') }}" class="mb-3" method="get">
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
                    <a class="btn btn-success" href={{ route('tenistas.create') }}>Nuevo Tenista</a>
                @endif
            </div>
        </div>
        @if($tenistas != null && count($tenistas) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Puntos</th>
                    <th>Best ranking</th>
                </tr>
                </thead>
                @foreach($tenistas as $tenista)
                    <tbody>
                    <tr>
                        <td>{{$tenista -> ranking}}</td>
                        <td>
                            @if($tenista->imagen != Tenista::$IMAGE_DEFAULT)
                                <img alt="Imagen del tenista" height="50" src="{{ $tenista->imagen_url }}"
                                     width="50">
                            @else
                                <img alt="Imagen por defecto" height="50" src="{{ Tenista::$IMAGE_DEFAULT }}"
                                     width="50">
                            @endif
                        </td>
                        <td><a href="{{ route('tenistas.show', $tenista->id) }}" style="color: inherit; text-decoration: none">{{$tenista -> nombre}}</a></td>
                        <td>{{$tenista -> edad}}</td>
                        <td>{{$tenista -> puntos}}</td>
                        <td>{{$tenista -> best_ranking}}</td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        @else
            <p class='lead'><em>No se ha encontrado datos de tenistas.</em></p>
        @endif
    </div>

    <div class="pagination-container">
        {{ $tenistas->links('pagination::bootstrap-4') }}
    </div>
@endsection
