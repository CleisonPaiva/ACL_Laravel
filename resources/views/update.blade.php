@extends('layouts.app')

@section('content')
    <div class="container">



            <strong>Autor: {{$post->user->name}}</strong>
            <h2>{{$post->title}}</h2>
            <p>{{$post->description}}</p>



            <hr>


    </div>
@endsection
