# Employees API Documentation

## Base URL

`/api/employees`

------------------------------------------------------------------------

## Endpoints

### 1. Get All Employees (Paginated)

**GET** `/api/employees`

**Query Parameters** \| Name \| Type \| Description \|
\|------\|------\|-------------\| \| `page` \| integer \| Page number \|
\| `status` \| string \| Filter by status (`active`, `inactive`) \| \|
`keyword` \| string \| Search by name, email, position, or salary \|

**Response (200)**

``` json
{
  "data": [...],
  "current_page": 1,
  "last_page": 5,
  "total": 100
}
```

**Response (404)**

``` json
{
  "message": "No employees found"
}
```

------------------------------------------------------------------------

### 2. Get Employee by ID

**GET** `/api/employees/{id}`

**Response (200)** Employee data

**Response (404)**

``` json
{
  "message": "Employee not found"
}
```

------------------------------------------------------------------------

### 3. Create Employee

**POST** `/api/employees`

**Validation Rules** - `name`: required, string, max:100\
- `email`: required, email, unique\
- `position`: required, string\
- `salary`: required, integer, min:2000000, max:50000000\
- `status`: required, in:`active`,`inactive`\
- `hired_at`: nullable, date

**Response (201)** Employee created

**Response (422)** Validation error

------------------------------------------------------------------------

### 4. Update Employee

**PUT/PATCH** `/api/employees/{id}`

**Email unique rule** `unique:employees,email,{id}` → Email valid jika
email milik pegawai itu sendiri

------------------------------------------------------------------------

### 5. Soft Delete Employee

**DELETE** `/api/employees/{id}`

Menggunakan `SoftDeletes` pada model.

**Response (200)**

``` json
{ "message": "Employee deleted" }
```

------------------------------------------------------------------------

## Error Handling

-   `ModelNotFoundException` → 404\
-   Validation errors → 422\
-   Query results empty → custom 404

------------------------------------------------------------------------

## Setup After Cloning Repo

    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan serve

------------------------------------------------------------------------

## Notes

-   Supports filtering, keyword search, pagination\
-   Results return 404 jika data tidak ditemukan
