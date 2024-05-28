@php use App\Models\Torneo @endphp

@extends('main')

@section('title', 'Actualizar imagen')

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

    <dl class="row" style="padding-left: 20px">
        <dt class="col-sm-2" style="color: coral">ID:</dt>
        <dd class="col-sm-10">{{$torneo->id}}</dd>
        <dt class="col-sm-2" style="color: coral">Nombre:</dt>
        <dd class="col-sm-10">{{$torneo->nombre}}</dd>
        <dt class="col-sm-2" style="color: coral">Imagen:</dt>
        <dd class="col-sm-10">
            @if($torneo->imagen != Torneo::$IMAGE_DEFAULT)
                <img alt="Imagen del torneo" class="img-fluid" src="{{ asset('storage/' . $torneo->imagen) }}">
            @else
                <img alt="Imagen por defecto" class="img-fluid" src="{{ Torneo::$IMAGE_DEFAULT }}">
            @endif
        </dd>
    </dl>

    <form action="{{ route("torneos.updateImage", $torneo->id) }}" method="post" enctype="multipart/form-data" style="padding-left: 20px">
        @csrf
        @method('PATCH')
        <div class="form-group d-flex justify-content-evenly">
            <label for="imagen" style="color: coral; font-weight: bold; margin-right: 20px">Nueva imagen:</label>
            <input accept="image/*" class="form-control-file" id="imagen" name="imagen" required type="file">
            <small class="text-danger"></small>
        </div>
        <br>
        <div>
            <button class="btn" type="submit" style="background-color: coral; color: white">Actualizar</button>
        </div>
    </form>
@endsection
