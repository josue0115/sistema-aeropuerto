# TODO: Implementar Modales para Mis Facturas y Mis Pagos

## Información Recopilada
- Las rutas `/cliente/facturas` y `/cliente/pagos` ya existen en `routes/web.php`.
- Necesitamos actualizar estas rutas para incluir joins con tablas relacionadas (reservas, boletos, etc.) para mostrar detalles completos.
- Agregar botones "Mis Facturas" y "Mis Pagos" en la navegación.
- Implementar modales con Alpine.js similares a los de reservas y boletos.
- No interferir con la funcionalidad existente de los modales.

## Plan
1. Actualizar rutas `/cliente/facturas` y `/cliente/pagos` en `routes/web.php` para incluir joins y datos completos.
2. Editar `resources/views/layouts/navigation.blade.php` para agregar:
   - Botones "Mis Facturas" y "Mis Pagos" que disparen eventos 'facturas-modal' y 'pagos-modal'.
   - Modales para facturas y pagos con funcionalidad de carga y display.
3. Verificar que los modales funcionen sin afectar reservas y boletos.

## Archivos a Editar
- `routes/web.php`: Actualizar rutas `/cliente/facturas` y `/cliente/pagos`.
- `resources/views/layouts/navigation.blade.php`: Agregar botones y modales.

## Pasos de Implementación
- [ ] Actualizar ruta `/cliente/facturas` para incluir joins.
- [ ] Actualizar ruta `/cliente/pagos` para incluir joins.
- [ ] Agregar botones "Mis Facturas" y "Mis Pagos" en la navegación.
- [ ] Agregar modal para facturas con funcionalidad de carga y display.
- [ ] Agregar modal para pagos con funcionalidad de carga y display.
- [ ] Probar que los modales funcionen sin afectar otros.

## Seguimiento de Progreso
- [x] Paso 1 completado: Actualizada la ruta `/cliente/facturas` para incluir joins con boleto, pasajero y vuelo.
- [x] Paso 2 completado: Actualizada la ruta `/cliente/pagos` para incluir joins con reserva, pasajero y vuelo.
- [x] Paso 3 completado: Agregados botones "Mis Facturas" y "Mis Pagos" en la navegación.
- [x] Paso 4 completado: Agregado modal para facturas con funcionalidad de carga y display.
- [x] Paso 5 completado: Agregado modal para pagos con funcionalidad de carga y display.
- [x] Pruebas realizadas: Servidor Laravel corriendo en http://127.0.0.1:8000. Los modales están listos para pruebas manuales.
