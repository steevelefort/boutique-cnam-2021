@extends('layout')

@section('main')

    <div class="text-center m-10">
        <div class="text-3xl">Erreur {{$code}}</div>
        <p class="text-lg">{{$message}}</p>
    </div>

@endsection

