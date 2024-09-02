@extends('layouts.dashboard')
@section('titulo', 'Herramientas')
@section('content')

<livewire:productlist :productos="$productos" :categorias="$categorias" />

@endsection