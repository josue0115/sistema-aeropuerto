# TODO: Actualizar Diseño Profesional de Login y Register

## Información Recopilada
- El usuario quiere un nuevo estilo más profesional y relacionado con el rubro de aeropuerto.
- Enfoque en web (no móvil), así que diseño optimizado para desktop con layout centrado.
- Ambos archivos necesitan actualización: login.blade.php y register.blade.php.

## Plan
1. Actualizar resources/views/auth/login.blade.php con:
   - Fondo de pantalla completa con imagen de pista de aeropuerto o avión despegando.
   - Layout centrado: tarjeta blanca con sombra, bordes redondeados.
   - Colores: azul marino (#003366), blanco, acentos en azul claro.
   - Íconos SVG: avión para email, llave para contraseña.
   - Formulario con campos con íconos, botones con gradiente sutil.
   - Texto relacionado: "Accede a tu panel de vuelos".
   - Footer: "Sistema Aeropuerto".
   - Responsivo mínimo, enfocado en web/desktop.

2. Actualizar resources/views/auth/register.blade.php con diseño similar, adaptado para registro (más campos).

## Archivos a Editar
- resources/views/auth/login.blade.php: Nuevo diseño centrado.
- resources/views/auth/register.blade.php: Nuevo diseño centrado.

## Pasos de Implementación
- [x] Actualizar login.blade.php con el nuevo diseño.
- [x] Actualizar register.blade.php con el nuevo diseño.
- [x] Ajustar tamaño de tarjetas para que quepan en la ventana sin scroll (removido overlay, reducido padding y ancho).
- [ ] Probar las páginas en navegador web.

## Seguimiento de Progreso
- [x] Paso 1 completado: Actualizado login.blade.php con diseño centrado, íconos, colores azul marino.
- [x] Paso 2 completado: Actualizado register.blade.php con diseño similar, adaptado para registro.
- [x] Paso 3 completado: Ajustado tamaño de tarjetas (login: 350px, register: 400px, padding 2rem) para que quepan en ventana sin scroll.
- [ ] Paso 4 pendiente: Probar páginas.
