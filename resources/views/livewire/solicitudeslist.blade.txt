@extends('layouts.dashboard')

@section('title', 'Solicitudes-instructor')

@section('content')

    <main class="main-content">
        <form action="{{ route('solicitudes.store') }}" method="POST">
            @csrf
    
            <h3>Crear Solicitud</h3> <!-- Título del formulario -->
    
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <small>Por favor ingrese la fecha de la solicitud</small>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            
            <div class="form-group">
                <label for="herramienta">Herramienta:</label>
                <small>Ingrese el nombre de la herramienta que necesita</small>
                <input type="text" id="herramienta" name="herramienta" required>
            </div>
            
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <small>Indique la cantidad requerida</small>
                <input type="number" id="cantidad" name="cantidad" required min="1">
            </div>
            
            <button type="submit">Enviar Solicitud</button>
        </form>
    </main>

    @can('crearHerramienta')
    <div class="solicitudes-container">
        <h1 class="titulo-centrado">Solicitudes</h1>
        
        @if($solicitudes->isEmpty())
            <p>No hay solicitudes para mostrar.</p>
        @else
            @foreach($solicitudes as $solicitud)
                <div class="card">
                    <div class="card-body">
                        <p><strong>Instructor:</strong> {{ $solicitud->instructor->name }}</p>
                        <p><strong>Fecha:</strong> {{ $solicitud->fecha }}</p>
                        <a href="#" data-modal="modal-{{ $solicitud->id }}" class="ver-detalles-btn">Ver Detalles</a>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $solicitud->id }}" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" onclick="closeModal({{ $solicitud->id }})">&times;</span>
                        <center><h2>Detalles de la Solicitud</h2></center>
                        <p><strong>ID:</strong> {{ $solicitud->id }}</p>
                        <p><strong>Instructor:</strong> {{ $solicitud->instructor->name }}</p>
                        <p><strong>Fecha:</strong> {{ $solicitud->fecha }}</p>
                        <p><strong>Herramienta:</strong> {{ $solicitud->herramienta }}</p>
                        <p><strong>Cantidad:</strong> {{ $solicitud->cantidad }}</p>
                        
                        <div class="modal-actions">
                            <form method="POST" action="{{ route('admin.solicitudes.aceptar', $solicitud->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Aceptar</button>
                            </form>
                            <form method="POST" action="{{ route('admin.solicitudes.rechazar', $solicitud->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Rechazar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @endcan
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.ver-detalles-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    var modalId = this.getAttribute('data-modal');
                    document.getElementById(modalId).style.display = 'block';
                });
            });
        });

        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }
    </script>
@endsection

@section('scripts')
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }

        window.onclick = function(event) {
            @foreach($solicitudes as $solicitud)
                if (event.target == document.getElementById('modal-{{ $solicitud->id }}')) {
                    document.getElementById('modal-{{ $solicitud->id }}').style.display = 'none';
                }
            @endforeach
        }
    </script>
@endsection
    <script>
   document.querySelector('.hamburger-menu').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('active');
});
    </script>
</body>


</html>
