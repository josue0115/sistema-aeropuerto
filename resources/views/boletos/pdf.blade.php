<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Boleto Aéreo - Dinámico</title>
    <!-- NOTA: He mantenido tu estructura original (sin Tailwind CDN) pero apliqué los estilos profesionales directamente en <style> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Configuración de color para un tema corporativo */
        :root {
            --primary-blue: #0A3C5F; /* Azul profundo */
            --secondary-teal: #00A99D; /* Teal para acentos */
            --bg-light: #F8FAFC;
        }

        /* Contenedor principal y estilos de fondo */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            display: flex;
            justify-content: center;
            /* Eliminado padding y margin del body para subirlo y moverlo a la izquierda */
            padding: 0; 
            color: #333;
            margin: 0; 
            width: 100%; 
        }

        .receipt-container {
            /* Eliminado max-width para que ocupe todo el ancho disponible */
            width: 100%;
            background-color: white;
            border-radius: 0; 
            box-shadow: none; 
            /* Reducido a 1rem 0.5rem para compresión en vista normal */
            padding: 1rem 0.5rem; 
            border-top: 5px solid var(--secondary-teal); 
            /* Centrado horizontal automático */
            margin: 0 auto; 
        }
        
        /* ENCABEZADO */
        .header {
            text-align: center;
            /* **AJUSTE: Reducido de 2rem a 1.5rem** */
            margin-bottom: 1.5rem; 
        }
        .header h1 {
            color: var(--primary-blue);
            margin: 0;
            font-size: 2rem; /* text-3xl */
            font-weight: 800; /* font-extrabold */
            letter-spacing: 0.05em; /* tracking-wider */
        }
        .header .subtitle {
            font-size: 1.25rem; /* text-xl */
            font-weight: 600; /* font-semibold */
            color: var(--primary-blue);
            margin-bottom: 0.25rem;
        }
        .header .date-text {
            font-size: 0.875rem; /* text-sm */
            color: #6B7280; /* gray-500 */
        }

        /* SECCIÓN */
        .section {
            /* **AJUSTE: Reducido de 1.5rem a 1rem** */
            margin-bottom: 1rem; 
            /* **AJUSTE: Reducido de 1rem a 0.75rem** */
            padding-top: 0.75rem; 
            border-top: 1px solid #E5E7EB; 
        }
        .section:first-of-type {
            border-top: none;
            padding-top: 0;
        }

        .section h2 {
            color: var(--primary-blue);
            border-left: 4px solid var(--secondary-teal);
            padding-left: 0.75rem;
            /* **AJUSTE: Reducido de 1rem a 0.5rem** */
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 1.5rem; /* text-2xl */
        }

        /* DETALLES (MANTENIENDO LA ESTRUCTURA DE TABLA DE TU CÓDIGO) */
        .details {
            display: table;
            width: 100%;
            border-spacing: 0;
            margin-top: -0.5rem; /* Ajuste para el padding vertical */
        }

        .details .row {
            display: table-row;
        }

        .details .row .label {
            display: table-cell;
            font-weight: 500; /* font-medium */
            color: #4B5563; /* gray-600 */
            width: 35%; /* Ligeramente más ancho para etiquetas */
            /* **AJUSTE: Reducido de 0.5rem a 0.3rem para juntar las filas** */
            padding: 0.3rem 0;
            border-bottom: 1px dashed #E5E7EB;
        }

        .details .row .value {
            display: table-cell;
            color: #1F2937; /* gray-800 */
            /* **AJUSTE: Reducido de 0.5rem a 0.3rem para juntar las filas** */
            padding: 0.3rem 0;
            border-bottom: 1px dashed #E5E7EB;
            font-weight: 400;
        }

        .details .row:last-child .label,
        .details .row:last-child .value {
            border-bottom: none;
        }

        /* ESTILOS ESPECÍFICOS */
        /* Total */
        .total-row .label, .total-row .value {
            border-top: 2px solid var(--primary-blue);
            /* **AJUSTE: Reducido de 1rem a 0.75rem** */
            padding-top: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-transform: uppercase;
        }
        .total-row .value {
            color: var(--secondary-teal);
            font-size: 2rem; /* text-3xl */
        }

        /* Icono de avión (Manteniendo tu SVG y ajustando las clases) */
        .airplane-icon {
            fill: var(--primary-blue);
            width: 28px;
            height: 28px;
            margin-right: 0.5rem;
            display: inline-block;
            vertical-align: middle;
        }

        /* Pie de página */
        .footer {
            text-align: center;
            /* **AJUSTE: Reducido de 2rem a 1.5rem** */
            margin-top: 1.5rem; 
            /* **AJUSTE: Reducido de 1rem a 0.75rem** */
            padding-top: 0.75rem;
            border-top: 1px solid #E5E7EB;
            font-size: 0.75rem; /* text-xs */
            color: #6B7280; /* gray-500 */
        }
        .footer p { margin: 0; line-height: 1.5; }
        .footer .signature {
            font-weight: 600;
            color: var(--primary-blue);
        }

        /* **AJUSTES PARA UNA SOLA PÁGINA PDF (ULTRA-ULTRA-COMPACTO)** */
        @media print {
            /* Mantenemos la compresión máxima para asegurar una página */
            body {
                /* Reducción mínima de fuente */
                font-size: 82%; 
            }
            .receipt-container {
                /* Padding mínimo en impresión */
                padding: 0.3rem; 
                margin: 0;
                box-shadow: none;
                border-radius: 0;
            }
            /* Ajustes finos de márgenes */
            .section {
                /* Reducido aún más */
                margin-bottom: 0.4rem; 
                padding-top: 0.4rem;
            }
            .header {
                /* Reducido aún más */
                margin-bottom: 0.75rem;
            }
            .details .row .label,
            .details .row .value {
                /* Padding de fila ultra-compacto en impresión */
                padding: 0.2rem 0;
            }
            .footer {
                margin-top: 0.75rem; 
            }
            /* Intentar evitar saltos de página dentro de las secciones */
            .section, .header, .footer {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <div class="receipt-container">
        <!-- ENCABEZADO Y LOGOTIPO -->
        <div class="header">
            <!-- Ícono de avión para profesionalismo -->
            <div style="display: flex; items-align: center; justify-content: center; margin-bottom: 8px;">
                <svg class="airplane-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2.5 17L11 21.5V17H2.5zM13 17V21.5L21.5 17H13zM11 15V3L5 6.5V15h6zM13 15V6.5L19 3V15h-6z"/>
                </svg>
                <h1>AEROLINEASGT</h1>
            </div>
            <p class="subtitle">Comprobante de Compra de Boleto</p>
            <p class="date-text">Fecha de Emisión: **{{ date('d/m/Y H:i') }}**</p>
        </div>

        <!-- SECCIÓN: INFORMACIÓN DEL BOLETO (Finanzas) -->
        <div class="section">
            <h2>Detalles Financieros (Boleto)</h2>
            <div class="details">
                <div class="row">
                    <div class="label">ID Boleto:</div>
                    <div class="value" style="font-weight: 700; color: var(--secondary-teal); font-size: 1.125rem;">{{ $boleto->idBoleto }}</div>
                </div>
                <div class="row">
                    <div class="label">Fecha de Compra:</div>
                    <div class="value">{{ $boleto->FechaCompra }}</div>
                </div>
                <div class="row">
                    <div class="label">Precio Unitario:</div>
                    <div class="value">${{ number_format($boleto->Precio, 2) }}</div>
                </div>
                <div class="row">
                    <div class="label">Cantidad:</div>
                    <div class="value">{{ $boleto->Cantidad }}</div>
                </div>
                <div class="row">
                    <div class="label">Descuento:</div>
                    <div class="value" style="color: #DC2626; font-weight: 600;">${{ number_format($boleto->Descuento ?? 0, 2) }}</div>
                </div>
                <div class="row">
                    <div class="label">Impuesto (IVA/Tasas):</div>
                    <div class="value">${{ number_format($boleto->Impuesto ?? 0, 2) }}</div>
                </div>

                <!-- TOTAL FINAL -->
                <div class="row total-row">
                    <div class="label">Total Pagado:</div>
                    <div class="value">${{ number_format($boleto->Total, 2) }}</div>
                </div>
            </div>
        </div>

        @if($pasajero)
        <!-- SECCIÓN: INFORMACIÓN DEL PASAJERO -->
        <div class="section">
            <h2>Información del Pasajero</h2>
            <div class="details">
                <div class="row">
                    <div class="label">ID Pasajero:</div>
                    <div class="value">{{ $pasajero->idPasajero }}</div>
                </div>
                <div class="row">
                    <div class="label">Nombre Completo:</div>
                    <div class="value" style="text-transform: uppercase; font-weight: 500;">{{ $pasajero->Nombre }} {{ $pasajero->Apellido }}</div>
                </div>
                <div class="row">
                    <div class="label">País de Residencia:</div>
                    <div class="value">{{ $pasajero->Pais }}</div>
                </div>
                <div class="row">
                    <div class="label">Tipo de Pasajero:</div>
                    <div class="value">{{ $pasajero->TipoPasajero }}</div>
                </div>
            </div>
        </div>
        @endif

        @if($vuelo)
        <!-- SECCIÓN: INFORMACIÓN DEL VUELO -->
        <div class="section">
            <h2>Detalles del Vuelo</h2>
            <div class="details">
                <div class="row">
                    <div class="label">ID Vuelo:</div>
                    <div class="value">{{ $vuelo->idVuelo }}</div>
                </div>
                <div class="row">
                    <div class="label">Salida (Fecha/Hora):</div>
                    <div class="value" style="font-weight: 600;">{{ $vuelo->FechaSalida }}</div>
                </div>
                <div class="row">
                    <div class="label">Llegada Estimada (Fecha/Hora):</div>
                    <div class="value" style="font-weight: 600;">{{ $vuelo->FechaLlegada }}</div>
                </div>
                <div class="row">
                    <div class="label">Precio Base del Vuelo:</div>
                    <div class="value">${{ number_format($vuelo->Precio, 2) }}</div>
                </div>
                <div class="row">
                    <div class="label">Estado del Vuelo:</div>
                    <div class="value" style="color: #10B981; font-weight: 700;">{{ $vuelo->Estado }}</div>
                </div>
            </div>
        </div>
        @endif

        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <p>Gracias por su compra. Este documento es un comprobante oficial y puede ser utilizado como factura.</p>
            <p class="signature">Sistema de Aeropuerto - Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
