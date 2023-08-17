@extends('layouts.app')

@section('titulo')

Principal

@endsection


@section('contenido')
    <h1 class="font-black text-2xl mb-10">Siguiendo</h1>
    <x-listar-post :posts="$postFollow"/>

    <h1 class="font-black text-2xl mb-10">Descubre</h1>
    <x-listar-post :posts="$postNotFollow"/>

    {{-- @forelse ($postNotFollow as $post)
        <h1>Descubre</h1>
    @empty
        <p>No hay post</p>
    @endforelse --}}
@endsection