# Agendify 📅

**Agendify** es una aplicación diseñada para la gestión de citas entre profesionales y clientes. Esta plataforma permite a los profesionales agendar, gestionar y recibir recordatorios de sus citas, facilitando el control de su agenda de manera eficiente y organizada.

## Funcionalidades 🚀

- **Registro de Profesionales**: Los profesionales pueden registrarse y crear su perfil con especialidades personalizadas.
- **Gestión de Clientes**: Los profesionales pueden registrar a sus clientes con información de contacto y residencia.
- **Agendado de Citas**: Permite a los profesionales programar citas para sus clientes, especificando la fecha, hora, servicio y motivo.
- **Recordatorios Automáticos**: El sistema envía recordatorios automáticos a los profesionales sobre sus próximas citas.
- **Historial de Consultas**: Visualización de citas anteriores con todos los detalles importantes.
- **Visualización de Servicios**: Los profesionales pueden gestionar sus servicios ofrecidos.
- **Calendario**: Consulta rápida de las citas a través de un calendario interactivo.

## Tecnologías Utilizadas 🛠️

- **Backend**: [Laravel](https://laravel.com/) - Framework PHP.
- **Frontend**: Blade Templates con [Tailwind CSS](https://tailwindcss.com/).
- **Base de Datos**: MySQL.
- **Autenticación**: Sistema de autenticación propio de Laravel (login y registro).
- **Notificaciones**: Recordatorio


## Instalación ⚙️

1. Clona este repositorio:
   ```bash
   git clone https://github.com/tu-usuario/agendify.git
   ```

2. Navega hasta el directorio del proyecto:
   ```bash
   cd agendify
   ```

3. Instala las dependencias de PHP con Composer:
   ```bash
   composer install
   ```

4. Instala las dependencias de JavaScript con NPM:
   ```bash
   npm install
   ```

5. Configura tu archivo `.env` para la base de datos:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. Crea las tablas de la base de datos:
   ```bash
   php artisan migrate
   ```

7. Ejecuta el servidor local:
   ```bash
   php artisan serve
   ```

