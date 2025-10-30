<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura #{{ $factura['idFactura'] ?? 'N/A' }}</title>

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
            font-size: 1.25rem; /* Ajustado de 1.5rem para facturas */
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
            text-align: right; /* Alineación a la derecha para montos */
            padding-right: 0.5rem;
        }

        .details .row:last-child .label,
        .details .row:last-child .value {
            border-bottom: none;
        }

        /* ESTILOS DE TABLA DE DETALLES (Conceptos) */
        .detalles table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .detalles th, .detalles td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 0.875rem;
        }
        .detalles th {
            background-color: var(--primary-blue);
            color: white;
            font-weight: bold;
            text-align: center;
        }
        .detalles td:nth-child(2), .detalles td:nth-child(3), .detalles td:nth-child(4) {
            text-align: right;
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
            <p class="subtitle">Factura Electrónica N° **{{ $factura['idFactura'] ?? 'N/A' }}**</p>
            <p class="date-text">Fecha de Emisión: **{{ date('d/m/Y H:i', strtotime($factura['FechaEmision'] ?? now())) }}**</p>
        </div>

        <!-- SECCIÓN: INFORMACIÓN DEL CLIENTE Y VUELO -->
        <div class="section">
            <h2>Información General</h2>
            <div class="details">
                <!-- Cliente -->
                <div class="row">
                    <div class="label">Cliente:</div>
                    <div class="value">{{ $pasajero->Nombre ?? 'N/A' }} {{ $pasajero->Apellido ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="label">Tipo de Pasajero:</div>
                    <div class="value">{{ $pasajero->TipoPasajero ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Número de Boleto:</div>
                    <div class="value">{{ $boleto->idBoleto ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Ruta:</div>
                </div>
                <div class="row">
                    <div class="label">Origen:</div>
                    <div class="value">{{ $vuelo->aeropuerto_origen ?? 'N/A' }} </div>
                </div>
                <div class="row">
                    <div class="label">Destino:</div>
                    <div class="value">{{ $vuelo->aeropuerto_destino ?? 'N/A' }}</div>
                </div>
                <div class="row">
                    <div class="label">Fecha y Hora de Vuelo:</div>
                    <div class="value" style="font-weight: 600;">{{ $vuelo->FechaSalida ? date('d/m/Y H:i', strtotime($vuelo->FechaSalida)) : 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- SECCIÓN: DETALLES DE LA COMPRA (Tabla) -->
        <div class="section detalles">
            <h2>Detalles de la Compra</h2>

            @if($boleto)
            <table>
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Boleto de Vuelo (ID {{ $boleto->idVuelo ?? 'N/A' }})</td>
                        <td>1</td>
                        <td>${{ number_format($boleto->Precio ?? 0, 2) }}</td>
                        <td>${{ number_format($boleto->Precio ?? 0, 2) }}</td>
                    </tr>

                    @if(isset($asiento) && $asiento)
                    <tr>
                        <td>Cargo por Asiento (N° {{ $asiento->NumeroAsiento ?? 'N/A' }})</td>
                        <td>1</td>
                        <td>${{ number_format(($asiento->precio_vuelo ?? 0) * 0.1, 2) }}</td>
                        <td>${{ number_format(($asiento->precio_vuelo ?? 0) * 0.1, 2) }}</td>
                    </tr>
                    @endif

                    @foreach($servicios ?? [] as $servicio)
                    <tr>
                        <td>{{ $servicio->tipo_servicio ?? 'Servicio Adicional' }}</td>
                        <td>{{ $servicio->Cantidad ?? 1 }}</td>
                        <td>${{ number_format($servicio->costo_unitario ?? 0, 2) }}</td>
                        <td>${{ number_format($servicio->CostoTotal ?? 0, 2) }}</td>
                    </tr>
                    @endforeach

                    @if(isset($equipajes) && $equipajes)
                        @foreach($equipajes as $equipaje)
                        <tr>
                            <td>Equipaje ({{ $equipaje->Dimensiones ?? 'N/A' }} - {{ $equipaje->Peso ?? 0 }}kg)</td>
                            <td>1</td>
                            <td>${{ number_format($equipaje->Costo ?? 0, 2) }}</td>
                            <td>${{ number_format($equipaje->Monto ?? 0, 2) }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            @endif

            <!-- SECCIÓN: TOTALES FINALES -->
            <div class="details" style="width: 300px; float: right;">
                <div class="row">
                    <div class="label">Subtotal:</div>
                    <div class="value">${{ number_format($factura['monto'] ?? 0, 2) }}</div>
                </div>
                <div class="row">
                    <div class="label">Impuesto (12% IVA):</div>
                    <div class="value">${{ number_format($factura['impuesto'] ?? 0, 2) }}</div>
                </div>
                <div class="row total-row">
                    <div class="label">Total a Pagar:</div>
                    <div class="value">${{ number_format($factura['MontoTotal'] ?? 0, 2) }}</div>
                </div>
            </div>

            <div class="clear"></div>
        </div>

        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <p><strong>Estado de la Factura:</strong> {{ $factura['Estado'] ?? 'Emitida' }}</p>
            <p>Esta es una factura generada automáticamente por el Sistema de Aeropuerto.</p>
            <p>Fecha de generación: {{ date('d/m/Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
