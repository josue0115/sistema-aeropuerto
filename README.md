# Configuración de la Base de Datos en Laravel 💾

Para conectar tu aplicación **Laravel** a una base de datos **MySQL**, sigue estos pasos:

---

## 1. Crear la Base de Datos

Antes de configurar Laravel, debes **crear la base de datos** en tu servidor MySQL. Puedes hacerlo de las siguientes maneras:

### Usando phpMyAdmin:

1.  Abre `http://localhost/phpmyadmin` en tu navegador.
2.  Inicia sesión con tus credenciales de MySQL (por defecto, suele ser usuario **`root`** sin contraseña).
3.  En la pestaña **Bases de datos**, ingresa el nombre de la nueva base de datos (por ejemplo, `mi_aplicacion`) y haz clic en **Crear**.

### Usando la línea de comandos:

Si prefieres usar la terminal, ejecuta:


mysql -u root -p
CREATE DATABASE mi_aplicacion;
EXIT;
Asegúrate de reemplazar `mi_aplicacion` con el nombre que desees para tu base de datos.

---

## 2. Configurar las Credenciales en el Archivo `.env`

Laravel utiliza el archivo **`.env`** para gestionar las configuraciones del entorno, incluyendo las credenciales de la base de datos. Abre el archivo **`.env`** en la raíz de tu proyecto y localiza las siguientes líneas:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=nombre_de_usuario
DB_PASSWORD=contraseña
