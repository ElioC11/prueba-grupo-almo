# Tracking Logístico

## Descripción
Sistema de seguimiento de envíos logísticos desarrollado en Laravel con Filament. Permite buscar envíos por número de guía (tracking_number) y visualizar su historial completo de estados y ubicaciones. Incluye una interfaz de administración para gestionar envíos y un endpoint API para consultas externas.

## Requisitos
- PHP 8.1 o superior
- Composer
- Node.js 20+ (para compilar assets)
- MySQL o base de datos compatible
- XAMPP o servidor web con PHP

## Instalación
1. Clona o descarga el proyecto en tu servidor web (ej. XAMPP htdocs).
2. Instala dependencias de PHP: `composer install`
3. Copia .env.example a .env y configura la base de datos.
4. Genera clave: `php artisan key:generate`
5. Ejecuta migraciones: `php artisan migrate`
6. Instala dependencias de Node: `npm install`
7. Compila assets: `npm run build`
8. Opcional: Ejecuta seeders para datos de prueba: `php artisan db:seed`

## Configuración
- Base de datos: Configura en .env las credenciales de MySQL.
- Servidor: Ejecuta `php artisan serve` para desarrollo local.

## Estructura de la Base de Datos
El sistema utiliza las siguientes tablas principales:

- **users**: Usuarios del sistema (estándar Laravel).
- **locations**: Ubicaciones físicas donde ocurren eventos de envío (ej. Bodega Central, Sucursal Norte).
- **shipment_statuses**: Estados posibles de un envío (ej. Recibido, En tránsito, Entregado).
- **shipments**: Información principal de cada envío, incluyendo:
  - tracking_number: Número de guía único (string).
  - employee_name: Nombre del empleado responsable (string).
  - status_id: ID del estado actual (relación con shipment_statuses).
  - current_location_id: ID de la ubicación actual (relación con locations).
- **shipment_histories**: Historial de cambios de cada envío, con:
  - shipment_id: ID del envío (relación con shipments).
  - status_id: ID del estado en ese momento (relación con shipment_statuses).
  - location_id: ID de la ubicación en ese momento (relación con locations).
  - comments: Comentarios opcionales sobre el evento (text).
  - created_at: Fecha y hora del evento.

Las relaciones permiten rastrear el historial completo de cada envío desde su creación hasta entrega, mostrando cómo cambia de estado y ubicación a lo largo del tiempo.

## Uso
Accede al panel de administración en `http://localhost:8000/admin` (ajusta el puerto si es diferente).

### Funciones Disponibles
- **Lista de Envíos**: Ver todos los envíos con búsqueda por tracking_number o employee_name.
- **Buscar Envío Específico**: Página dedicada (`/admin/search-shipment-page`) para ingresar un número de guía y ver su historial completo en una tabla.

## Endpoint API para Solicitar Información
El sistema incluye un endpoint REST API para consultas externas:

- **URL**: `GET /api/tracking/{tracking_number}`
- **Descripción**: Devuelve información detallada de un envío específico en formato JSON.
- **Parámetros**:
  - `tracking_number`: Número de guía del envío (string, requerido en la URL).
- **Respuesta Exitosa (200)**:
  ```json
  {
    "tracking_number": "ABC123456",
    "status": "En tránsito",
    "current_location": "Sucursal Norte",
    "recipient_employee": "Juan Pérez",
    "history": [
      {
        "date": "2026-03-31T10:00:00Z",
        "location": "Bodega Central",
        "status": "Recibido",
        "comments": "Paquete recibido en bodega"
      },
      {
        "date": "2026-03-31T14:00:00Z",
        "location": "Sucursal Norte",
        "status": "En tránsito",
        "comments": "Enviado a sucursal"
      }
    ]
  }
  ```
- **Respuesta de Error (404)**:
  ```json
  {
    "message": "Numero de seguimiento no encontrado, porfavor ingresalo nuevamente"
  }
  ```
- **Uso**: Realiza una petición GET a `http://tu-dominio/api/tracking/ABC123456` para obtener el historial del envío con guía ABC123456. Útil para integraciones con otros sistemas o consultas programáticas.
