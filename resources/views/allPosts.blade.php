<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/stylecard.css') }}">
</head>
<body>

    <div class="container">
        <h1>Bienvenido a Mi Blog</h1>
<br><br>
        <!-- Lista de posts -->
        <div class="grid">
            @foreach ($posts as $post)
                <div class="card">
                <img src="{{ asset('storage/images/' . $post->image_url) }}" alt="{{ $post->title }}">

                    <div class="content">
                        <h2>{{ $post->title }}</h2>
                        <p>{{ Str::limit($post->body, 100) }}</p>
                        <p class="date">{{ $post->created_at->format('d/m/Y H:i') }}</p>

                    </div>
                </div>
            @endforeach
        </div>

        <!-- Mensaje cuando no hay posts -->
        @if($posts->isEmpty())
            <p class="empty-message">No hay posts disponibles.</p>
        @endif
    </div>

</body>
</html>
