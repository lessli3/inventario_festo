@extends('layouts.dashboard')
@section('titulo', 'Solicitudes')
@section('content')

<livewire:solicitudeslist :solicitudes="$solicitudes"/>

@endsection