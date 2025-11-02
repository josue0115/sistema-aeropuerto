<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva #{{ $reserva->idReserva }}</title>

    <!-- Fuente compatible con PDF -->
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
            /* Usamos DejaVu Sans para asegurar compatibilidad con Dompdf */
            font-family: 'DejaVu Sans', sans-serif;
            background-color: var(--bg-light);
            display: flex;
            justify-content: center;
            padding: 0;
            color: #333;
            margin: 0;
            width: 100%;
        }

        .receipt-container {
            width: 100%;
            background-color: white;
            border-radius: 0;
            box-shadow: none;
            padding: 1rem 0.5rem;
            border-top: 5px solid var(--secondary-teal);
            margin: 0 auto;
        }

        /* ENCABEZADO */
        .header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .header h1 {
            color: var(--primary-blue);
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 0.05em;
        }
        .header .subtitle {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-blue);
            margin-bottom: 0.25rem;
        }
        .header .date-text {
            font-size: 0.875rem;
            color: #6B7280;
        }

        /* SECCIÓN */
        .section {
            margin-bottom: 1rem;
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
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 1.25rem;
        }

        /* DETALLES */
        .details {
            display: table;
            width: 100%;
            border-spacing: 0;
            margin-top: -0.5rem;
        }

        .details .row {
            display: table-row;
        }

        .details .row .label {
            display: table-cell;
            font-weight: 500;
            color: #4B5563;
            width: 35%;
            padding: 0.3rem 0;
            border-bottom: 1px dashed #E5E7EB;
        }

        .details .row .value {
            display: table-cell;
            color: #1F2937;
            padding: 0.3rem 0;
            border-bottom: 1px dashed #E5E7EB;
            font-weight: 400;
            text-align: right;
            padding-right: 0.5rem;
        }

        .details .row:last-child .label,
        .details .row:last-child .value {
            border-bottom: none;
        }

        /* ESTILOS ESPECÍFICOS: TOTAL */
        .total-row .label, .total-row .value {
            border-top: 2px solid var(--primary-blue);
            padding-top: 0.75rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-blue);
            text-transform: uppercase;
        }
        .total-row .value {
            color: var(--secondary-teal);
            font-size: 2rem;
        }

        .footer {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 0.75rem;
            border-top: 1px solid #E5E7EB;
            font-size: 0.75rem;
            color: #6B7280;
        }
        .footer p { margin: 0; line-height: 1.5; }

        /* Icono de avión */
        .airplane-icon {
            fill: var(--primary-blue);
            width: 28px;
            height: 28px;
            margin-right: 0.5rem;
            display: inline-block;
            vertical-align: middle;
        }
        .clear { clear: both; }

        /* Ajustes para Impresión/PDF */
        @media print {
            body { font-size: 10px; }
            .receipt-container { padding: 10px; }
        }
    </style>
</head>
<body>

    <div class="receipt-container">
        <!-- ENCABEZADO Y LOGOTIPO -->
        <div class="header">
            <div style="display: flex; items-align: center; justify-content: center; margin-bottom: 8px;">
                <!-- Ícono de avión para profesionalismo -->
                <svg class="airplane-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2.5 17L11 21.5V17H2.5zM13 17V21.5L21.5 17H13zM11 15V3L5 6.5V15h6zM13 15V6.5L19 3V15h-6z"/>
                </svg>
                <h1>AEROLINEASGT</h1>
            </div>
            <p class="subtitle">Confirmación de Reserva N° {{ $reserva->idReserva }}</p>
            <p class="date-text">Fecha de Reserva: {{ date('d/m/Y H:i', strtotime($reserva->FechaReserva)) }}</p>
        </div>

        <!-- SECCIÓN: INFORMACIÓN DE LA RESERVA -->
        <div class="section">
            <h2>Información de la Reserva</h2>
            <div class="details">
                <div class="row">
                    <div class="label">Número de Reserva:</div>
                    <div class="value">{{ $reserva->idReserva }}</div>
                </div>
                <div class="row">
                    <div class="label">Fecha de Reserva:</div>
                    <div class="value">{{ date('d/m/Y H:i', strtotime($reserva->FechaReserva)) }}</div>
                </div>
                <div class="row">
                    <div class="label">Fecha del Vuelo:</div>
                    <div class="value">{{ date('d/m/Y H:i', strtotime($reserva->FechaVuelo)) }}</div>
                </div>
                <div class="row">
                    <div class="label">Estado:</div>
                    <div class="value">{{ $reserva->Estado }}</div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: DETALLE DEL PASAJERO -->
        <div class="section">
            <h2>Detalle del Pasajero</h2>
            <div class="details">
                <div class="row">
                    <div class="label">Nombre Completo:</div>
                    <div class="value">{{ $pasajero->Nombre }} {{ $pasajero->Apellido }}</div>
                </div>
                <div class="row">
                    <div class="label">País:</div>
                    <div class="value">{{ $pasajero->Pais }}</div>
                </div>
                <div class="row">
                    <div class="label">Tipo de Pasajero:</div>
                    <div class="value">{{ $pasajero->TipoPasajero }}</div>
                </div>
                <div class="row">
                    <div class="label">Código de Pasajero:</div>
                    <div class="value">{{ $pasajero->idPasajero }}</div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: ITINERARIO DE VUELO -->
        <div class="section">
            <h2>Itinerario de Vuelo</h2>
            <div class="details">
                <div class="row">
                    <div class="label">Número de Vuelo:</div>
                    <div class="value">{{ $vuelo->IdVuelo }}</div>
                </div>
                <div class="row">
                    <div class="label">Origen:</div>
                    <div class="value">{{ $vuelo->aeropuerto_origen ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Destino:</div>
                    <div class="value">{{ $vuelo->aeropuerto_destino ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Fecha y Hora de Salida:</div>
                    <div class="value">{{ $vuelo->FechaSalida ? date('d/m/Y H:i', strtotime($vuelo->FechaSalida)) : 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Fecha y Hora de Llegada:</div>
                    <div class="value">{{ $vuelo->FechaLlegada ? date('d/m/Y H:i', strtotime($vuelo->FechaLlegada)) : 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Precio del Vuelo:</div>
                    <div class="value">${{ number_format($vuelo->Precio, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: RESUMEN DE PAGO -->
        <div class="section">
            <h2>Resumen de Pago</h2>
            <div class="details">
                <div class="row">
                    <div class="label">Monto Anticipado (10%):</div>
                    <div class="value">${{ number_format($reserva->MontoAnticipado, 2) }}</div>
                </div>
                <div class="row total-row">
                    <div class="label">Total a Pagar:</div>
                    <div class="value">${{ number_format($reserva->MontoAnticipado, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: INFORMACIÓN IMPORTANTE -->
        <div class="section">
            <h2>Información Importante</h2>
            <div style="font-size: 0.875rem; line-height: 1.5; color: #4B5563;">
                <p><strong>Política de Cancelación:</strong> Las cancelaciones realizadas con más de 24 horas de anticipación recibirán un reembolso del 80% del monto pagado. Cancelaciones dentro de las 24 horas no son reembolsables.</p>
                <p><strong>Documentos Requeridos:</strong> Presente su identificación oficial y el comprobante de esta reserva al momento del check-in.</p>
                <p><strong>Check-in:</strong> El check-in debe realizarse al menos 2 horas antes de la salida del vuelo.</p>
                <p><strong>Equipaje:</strong> Verifique las restricciones de equipaje permitidas para su vuelo.</p>
                <p><strong>Cambios:</strong> Los cambios en la reserva están sujetos a disponibilidad y pueden incurrir en cargos adicionales.</p>
            </div>
        </div>

        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <p>Esta es una confirmación de reserva generada automáticamente por el Sistema de Aeropuerto.</p>
            <p>Fecha de generación: {{ date('d/m/Y H:i:s') }}</p>
            <p>Para cualquier consulta, contacte a nuestro servicio al cliente.</p>
        </div>
    </div>
</body>
</html>
