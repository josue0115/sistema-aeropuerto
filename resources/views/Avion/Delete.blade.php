<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Avión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo para simular el fondo oscuro detrás del modal */
        body {
            background-color: #f8f9fa; 
        }
        .modal-backdrop.show {
            opacity: 0.5;
        }
    </style>
</head>
<body>

<!-- Simulación del contenedor principal (sin el fondo oscuro del modal) -->
<div class="container mt-4">
    <h1 class="mb-4">Eliminar Avión</h1>

    <!-- Modal Eliminar (Simulación, usando 'show' y 'display: block') -->
    <div class="modal fade show" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="false" style="display: block; background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
                    <!-- Botón de cierre que redirige a listar -->
                    <a href="#" onclick="event.preventDefault(); alert('Redirigiendo a la lista de aviones');" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <p><strong>¿Estás seguro de que deseas eliminar este avión?</strong></p>
                    
                    <!-- ESTRUCTURA DE DOS COLUMNAS USANDO Bootstrap Grid -->
                    <div class="row">
                        
                        <!-- Columna 1.1 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">ID Avión</label>
                            <!-- Simulación de datos de $avion -->
                            <input type="text" class="form-control" value="A101" readonly>
                        </div>
                        
                        <!-- Columna 1.2 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Aerolínea</label>
                            <input type="text" class="form-control" value="Air France" readonly>
                        </div>
                        
                        <!-- Columna 2.1 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Placa</label>
                            <input type="text" class="form-control" value="F-GSPT" readonly>
                        </div>
                        
                        <!-- Columna 2.2 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Tipo</label>
                            <input type="text" class="form-control" value="Airbus A320" readonly>
                        </div>
                        
                        <!-- Columna 3.1 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Modelo</label>
                            <input type="text" class="form-control" value="A320-200" readonly>
                        </div>
                        
                        <!-- Columna 3.2 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Capacidad</label>
                            <input type="text" class="form-control" value="180" readonly>
                        </div>
                        
                        <!-- Columna 4.1 -->
                        <div class="col-6 mb-3">
                            <label class="form-label fw-bold">Estado</label>
                            <input type="text" class="form-control" value="Activo" readonly>
                        </div>
                        <!-- La última columna queda vacía aquí -->
                    </div>
                    <!-- FIN ESTRUCTURA DE DOS COLUMNAS -->
                    
                </div>
                <div class="modal-footer">
                    <!-- Botón Cancelar -->
                    <a href="#" onclick="event.preventDefault(); alert('Cancelado');" class="btn btn-secondary">Cancelar</a>
                    
                    <!-- Formulario de Eliminación (Simulación) -->
                    <form action="#" method="POST" style="display:inline;">
                        <!-- @csrf y @method('DELETE') omitidos por ser HTML estático -->
                        <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); alert('Avión Eliminado');">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
