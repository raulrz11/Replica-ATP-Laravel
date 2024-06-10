@php use App\Models\Torneo @endphp

@extends('main')

@section('title', 'Actualizar imagen')

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

    <div style="width: 100%; display: flex; justify-content: center; align-items: center; padding: 20px">
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; border: 2px solid #007bff; border-radius: 20px; padding: 20px">
            @if($torneo->imagen != Torneo::$IMAGE_DEFAULT)
                <img alt="Imagen del torneo" class="img-fluid" src="{{ $torneo->imagen_url }}" width="300px" height="300px">
            @else
                <img alt="Imagen por defecto" class="img-fluid" src="{{ Torneo::$IMAGE_DEFAULT }}" width="300px" height="300px">
            @endif
            <form action="{{ route("torneos.updateImage", $torneo->id) }}" method="post" enctype="multipart/form-data" style="padding-left: 20px; margin-top: 40px">
                @csrf
                @method('PATCH')
                <div class="form-group d-flex justify-content-evenly">
                    <label for="imagen" style="color: #007bff; font-weight: bold; margin-right: 20px">Imagen:</label>
                    <input accept="image/*" class="form-control-file" id="imagen" name="imagen" required type="file">
                    <small class="text-danger"></small>
                </div>
                <br>
                <div style="display: flex; justify-content: center">
                    <button class="btn" type="submit" style="background-color: #007bff; color: white">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
