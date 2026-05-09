# Evaluación 2 - Sprint 1

## Integrantes

- Mixiu Perez
- Andrea Carreño
- Sofia Benavente

## Descripción

API REST en Laravel para gestionar clientes de Fintech Solutions S.A. La persistencia se maneja con MySQL, migrations y Eloquent.

## Implementación

- Tabla `clients` adaptada al contrato solicitado.
- Modelo `Client` con `fillable`.
- Controlador `ClientController` con `index`, `store` y `show`.
- Rutas versionadas en `/api/v1/clientes`.
- Respuestas JSON con códigos `200`, `201`, `404` y `422`.
- Colección Postman para pruebas.

## Requisitos

- Docker y Docker Compose
- Puerto `8000` libre

## Credenciales locales de BD

```text
Host: db
Port: 3306
Database: db-fintech
User: root
Password: docker
```

## Levantar el proyecto

Con Docker:

```bash
docker compose up -d --build
```

El proyecto queda disponible en:

```text
http://localhost:8000
```

## Correr migraciones

```bash
docker compose exec app php artisan migrate
```

Si quieres empezar desde cero:

```bash
docker compose down -v
docker compose up -d --build
docker compose exec app php artisan migrate
```

## Probar la API

Health:

```bash
curl -H "Accept: application/json" http://localhost:8000/api/health
```

Clientes:

```bash
curl -H "Accept: application/json" http://localhost:8000/api/v1/clientes
```

## Endpoints

| Método | Endpoint | Respuesta |
|---|---|---|
| GET | `/api/health` | `200` |
| GET | `/api/v1/clientes` | `200` |
| POST | `/api/v1/clientes` | `201` |
| GET | `/api/v1/clientes/{id}` | `200` / `404` |

## Validaciones

- `rut` requerido y único
- `nombre` requerido
- `apellido` requerido
- `email` requerido, formato email y único
- `telefono` opcional y único cuando se envía

## Ejemplo de POST

```json
{
  "rut": "12345678-9",
  "nombre": "Pedro",
  "apellido": "Pérez",
  "email": "pedro@example.com",
  "telefono": "987654321"
}
```

## Colección Postman

Archivo:

```text
EVA2_BENAVENTE.postman_collection.json
```

Incluye casos de:

- listado
- creación válida
- consulta por ID
- `404` por ID inexistente
- `422` por `rut` repetido
- `422` por `email` repetido
- `422` por `telefono` repetido
- `422` por email inválido
- `422` por campos requeridos

## Notas

- El proyecto está preparado para ejecutarse con Docker aunque no exista un `.env` local.
- Las variables críticas están definidas en `docker-compose.yml`.
- Si cambias la BD o el esquema, vuelve a correr las migrations.

