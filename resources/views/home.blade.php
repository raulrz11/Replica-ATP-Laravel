@extends('layouts.app')

@include('header')

@section('content')
<div class="row" style="margin: 30px; border: 2px solid white; border-radius: 20px">
    <div class="col-3" style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; border-right: 2px solid white">
        <div class="d-flex justify-content-center align-items-center" style="background-color: #007bff; color: white; padding: 10px; width: 200px; height: 200px; border-radius: 50%; margin-bottom: 20px">
            <span class="navbar-text" style="color: #413f3d; font-family: 'Rowdies'; font-size: 100px">
                {{ strtoupper(substr(auth()->user()->nombre ?? 'invitado/a', 0, 1)) }}
            </span>
        </div>
        <p style="color: white"><b>Nombre: </b>{{ auth()->user()->nombre }}</p>
        <p style="color: white"><b>Nombre de usuario: </b>{{ auth()->user()->username }}</p>
        <p style="color: white"><b>Email: </b>{{ auth()->user()->email }}</p>
    </div>
    <div class="col-9" style="background-color: white; border-radius: 20px; border: 10px solid #051224; padding: 4px;">

    </div>
</div>
@endsection
