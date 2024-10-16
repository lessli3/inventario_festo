<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600" rel="stylesheet" />

    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')

    <!-- Tu archivo CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div class="container mx-auto p-6">
<!-- 
      <button onclick="openModal('addModal')" class="btn-primary">
                    Agregar Nuevo Post
                </button>      
-->
                <!-- Botón para abrir el modal de agregar -->
                
<!-- Modal para agregar post -->
<div id="addModal" class="modal hidden fixed w-full h-full top-0 left-0 flex items-center justify-center modal-bg">
    <div class="modal-content bg-white p-8 rounded-xl shadow-lg relative w-full max-w-lg transition-transform transform scale-95 opacity-0">
        <span class="close absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl font-bold cursor-pointer" onclick="closeModal('addModal')">&times;</span>
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Agregar Nuevo Post</h2>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium mb-2">Código</label>
                <input type="text" id="title" name="title" class="input-field" placeholder="Título del post" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-medium mb-2">Nombre</label>
                <textarea id="content" name="body" class="input-field" placeholder="Contenido del post" required></textarea>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Descripción</label>
                <textarea id="description" name="description" class="input-field" placeholder="Descripción del post" required></textarea>
            </div>
            <div class="mb-4">
                <label for="stock" class="block text-gray-700 font-medium mb-2">Stock</label>
                <input type="number" id="stock" name="stock" class="input-field" placeholder="Cantidad de unidades" required min="0">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium mb-2">Categoria</label>
                <select id="status" name="status" class="input-field" required>
                    <option value="" disabled selected>Selecciona una categoria</option>
                    <option value="activo">Herramienta manual</option>
                    <option value="inactivo">Herramienta electrica</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-medium mb-2">Imagen</label>
                <input type="file" id="image" name="image" class="input-field" accept="image/*" required>
            </div>
            <div class="mb-4">
                <label for="c_barras" class="block text-gray-700 font-medium mb-2">Códigos de Barras</label>
                <input type="file" id="c_barras" name="c_barras" class="input-field" accept="image/*" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-medium mb-2">Estado</label>
                <select id="status" name="status" class="input-field" required>
                    <option value="" disabled selected>Selecciona un estado</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select>
            </div>
            <div class="flex justify-center space-x-4 mt-6">
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">Agregar Post</button>
                <button type="button" class="btn-secondary px-4 py-2 rounded-lg shadow-md hover:bg-gray-300 transition duration-200" onclick="closeModal('addModal')">Cerrar</button>
            </div>
        </form>
    </div>
</div>


                <br><br>

                <!-- Tabla -->
                <div class="mt-10 overflow-hidden rounded-lg shadow-lg mx-auto w-full max-w-4xl">
                    <table class="table-auto w-full text-left bg-white">
                        <thead>
                            <tr class="table-header">
                                <th class="px-4 py-4 text-gray-600">Codigo</th>
                                <th class="px-4 py-4 text-gray-600">Nombre</th>
                                <th class="px-4 py-4 text-gray-600">Descripción</th>
                                <th class="px-4 py-4 text-gray-600">Stock</th> <!-- Nueva columna para la fecha -->
                                <th class="px-4 py-4 text-gray-600">Categoria</th>
                                <th class="px-4 py-4 text-gray-600">imagen</th>
                                <th class="px-4 py-4 text-gray-600">C_barras</th>
                                <th class="px-4 py-4 text-gray-600">Estado</th>
                            </tr>
                        </thead>
    <tbody id="postsTable" class="divide-y divide-gray-200">
    @foreach ($posts as $post)
    <tr class="table-row">
        <td class="border px-4 py-4">
    
        <img src="{{ asset('storage/images/' . $post->imagen) }}" alt="Imagen del post">


        </td>
        <td class="border px-4 py-4">{{ $post->nombre }}</td>
        
        <td class="border px-4 py-4">
            <span style="display: inline-block;
            width: 180px;
            white-space: nowrap;
            overflow: hidden !important;
            text-overflow: ellipsis;"> 
                 {{ $post->descripcion }}
                </span>
          
        </td>
        <td class="border px-4 py-4">{{ $post->created_at->format('d/m/Y H:i') }}</td> <!-- Mostrar la fecha y la hora -->

        <td class="border px-4 py-4 flex space-x-2">
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts para manejar el modal -->
    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId).querySelector('.modal-content');
            document.getElementById(modalId).classList.remove('hidden');
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId).querySelector('.modal-content');
            modal.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('scale-100', 'opacity-100');
            setTimeout(() => {
                document.getElementById(modalId).classList.add('hidden');
            }, 200);
        }
    </script>
</body>
</html>