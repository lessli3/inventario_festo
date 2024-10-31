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