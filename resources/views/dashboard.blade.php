@extends('layouts.dashboard')

@section('title', 'Página de Inicio')

@section('content')
    <h1>Bienvenido a la página de inicio</h1>
    <p>Este es el contenido de la página de inicio.</p>

    <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a> <!-- Ajuste para usar una ruta nombrada -->
@endsection
