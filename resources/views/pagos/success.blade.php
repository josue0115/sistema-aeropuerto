@extends('layouts.app')

@section('title', 'Procesando Pago')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                    </div>
                    <h4>Procesando Pago...</h4>
                    <p class="text-muted">La factura se está descargando automáticamente.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Mostrar preloader de pantalla completa al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        showFullscreenLoader();
    });

    // Descargar la factura automáticamente
    //window.location.href = '/facturas/{{ $idFactura }}/pdf';
    // Crear un enlace temporal para la descarga
    const link = document.createElement('a');
    link.href = '/facturas/{{ $idFactura }}/pdf';
    link.download = 'factura-{{ $idFactura }}.pdf'; // Sugiere el nombre del archivo
    document.body.appendChild(link);
    link.click(); // Inicia la descarga
    document.body.removeChild(link);

    // Redirigir a la página de inicio después de un breve delay
    setTimeout(function() {
        //window.location.href = '/facturas/{{ $idFactura }}/pdf';
        window.location.href = '/';
    }, 3000);

    // Función para mostrar preloader de pantalla completa
    function showFullscreenLoader() {
        let loader = document.getElementById('fullscreen-loader');
        if (!loader) {
            loader = document.createElement('div');
            loader.id = 'fullscreen-loader';
            loader.innerHTML = `
                <div style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(255, 255, 255, 0.95);
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    z-index: 9999;
                    flex-direction: column;
                    border: 2px solid #007bff;
                    border-radius: 10px;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                ">
                    <img src="{{ asset('images/plane-loader.gif') }}" alt="Cargando..." style="width: 250px; height: 250px; margin-bottom: 20px;">
                    <h4 style="color: #007bff; font-weight: bold;">Procesando Pago...</h4>
                </div>
            `;
            document.body.appendChild(loader);
        }
        loader.style.display = 'flex';
    }

    // Función para ocultar preloader de pantalla completa
    function hideFullscreenLoader() {
        const loader = document.getElementById('fullscreen-loader');
        if (loader) {
            loader.style.display = 'none';
        }
    }
</script>
@endsection
