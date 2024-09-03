@extends('layouts.dashboard')
@section('titulo', 'Herramientas')
@section('content')

<livewire:herramientalist :herramientas="$herramientas" :categorias="$categorias" />

@endsection