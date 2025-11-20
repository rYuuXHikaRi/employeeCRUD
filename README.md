# Employees CRUD API Documentation

## Setup After Cloning Repo

    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan serve

------------------------------------------------------------------------

## Endpoints

### 1. Ambil semua data employee

**GET** `/api/employees`

**Query Parameters** - `page`: page number\
- `status`: 'active' or 'inactive'\
- `search`: string\

**Response (200)**
``` json
{
    "success": true,
    "message": "Data pegawai ditemukan",
    "current_page": 3,
    "total_pages": 3,
    "total_items": 27,
    "data" : [...],
    "links": {
        "next_page_url": null,
        "prev_page_url": "http://localhost:8080/api/employees?page=2"
    }
}
```

**Response (404)**

``` json
{
    "succes" : false,
    "message" : "Data pegawai tidak ditemukan"
}
```

------------------------------------------------------------------------

### 2. Ambil data pegawai berdasarkan id

**GET** `/api/employees/{id}`

**Response (200)** 

``` json

{
    "success": true,
    "message": "Data pegawai ditemukan",
    "data" : [....]
}

```

**Response (404)**

``` json
{
    "success" : false,
    "message" : "Data pegawai tidak ditemukan"
}
```

------------------------------------------------------------------------

### 3. Menambahkan data Employee

**POST** `/api/employees`

**Validation Rules** - `name`: required, string, max:100\
- `email`: required, email, unique\
- `position`: required, string\
- `salary`: required, integer, min:2000000, max:50000000\
- `status`: required, in:`active`,`inactive`\
- `hired_at`: nullable, date

**Response (201)**
``` json

{
    "success": true,
    "message": "Data pegawai berhasil ditambahkan",
    "data" : [....]
}

```

**Response (422)**
``` json

{
    "success": false,
    "message": "Validasi gagal",
    "details": {...}
}

```

------------------------------------------------------------------------

### 4. Update data pegawai

**PUT** `/api/employees/{id}`

on POSTMAN :
**POST** `/api/employees/{id}?_method=PUT` 

**Validation Rules** - `name`: required, string, max:100\
- `email`: required, email, unique -> valid jika email pegawai itu sendiri\
- `position`: required, string\
- `salary`: required, integer, min:2000000, max:50000000\
- `status`: required, in:`active`,`inactive`\
- `hired_at`: nullable, date

**Response (200)**
``` json

{
    "success": true,
    "message": "Data pegawai berhasil diupdate",
    "data": {....}
}

```

**Response (404)**
``` json

{
    "success": false,
    "message": "Data pegawai tidak ditemukan"
}

```

**Response (422)**
``` json

{
    "success": false,
    "message": "Validasi gagal",
    "details": {...}
}

```
------------------------------------------------------------------------

### 5. Hapus data pegawai

**DELETE** `/api/employees/{id}`

**Response (200)**

``` json
    "success": true,
    "message": "Data pegawai berhasil dihapus"
```

**Response (404)**
``` json

{
    "success": false,
    "message": "Data pegawai tidak ditemukan"
}

```

------------------------------------------------------------------------