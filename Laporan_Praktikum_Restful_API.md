# Laporan Praktikum - Restful API Laravel

**Nama**: Kharindra Argiansya  
**NIM**: V3925027  
**Kelas**: TI B  
**Angkatan**: 2025  

---

## 1. Registrasi Akun Baru (POST /api/register)
Digunakan untuk mendaftarkan akun administrator baru di database.

- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/register`
- **Headers**:
  ```http
  Accept: application/json
  ```
- **Request Body (JSON)**:
  ```json
  {
      "name": "Administrator",
      "email": "admin@gmail.com",
      "password": "password123",
      "password_confirmation": "password123"
  }
  ```
- **Response (201 Created)**:
  ```json
  {
      "success": true,
      "message": "Registrasi berhasil",
      "access_token": "1|pfTNon9NIQ7MAAv9KtdFTPGXC1o1OcE10XphMXFV169a29ce9",
      "token_type": "Bearer",
      "user": {
          "name": "Administrator",
          "email": "admin@gmail.com",
          "updated_at": "2026-07-07T11:59:06.000000Z",
          "created_at": "2026-07-07T11:59:06.000000Z",
          "id": 1
      }
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN REGISTRASI DI SINI]**

---

## 2. Login Akun & Penerbitan Token (POST /api/login)
Digunakan untuk memverifikasi kredensial pengguna dan menerbitkan Bearer Token.

- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/login`
- **Headers**:
  ```http
  Accept: application/json
  ```
- **Request Body (JSON)**:
  ```json
  {
      "email": "admin@gmail.com",
      "password": "password123"
  }
  ```
- **Response (200 OK)**:
  ```json
  {
      "success": true,
      "message": "Login berhasil",
      "access_token": "4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39",
      "token_type": "Bearer",
      "user": {
          "id": 1,
          "name": "Administrator",
          "email": "admin@gmail.com"
      }
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN LOGIN & ACCESS TOKEN DI SINI]**

---

## 3. Tambah Hasil Panen Baru (POST /api/harvests)
Digunakan untuk mencatat data hasil panen baru ke dalam database.

- **Method**: `POST`
- **URL**: `http://127.0.0.1:8000/api/harvests`
- **Headers**:
  ```http
  Accept: application/json
  Authorization: Bearer 4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39
  ```
- **Request Body (JSON)**:
  ```json
  {
      "nama_komoditas": "Tomat",
      "jumlah_kg": 450,
      "tanggal_panen": "2026-06-14"
  }
  ```
- **Response (201 Created)**:
  ```json
  {
      "data": {
          "id": 1,
          "commodity": "TOMAT",
          "weight": "450 kg",
          "harvested_at": "2026-06-14",
          "created_format": "2026-07-07 19:34:12"
      },
      "success": true,
      "message": "Data panen berhasil dicatat"
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN TAMBAH DATA PANEN DI SINI]**

---

## 4. Tampilkan Semua Data Panen (GET /api/harvests)
Digunakan untuk melihat seluruh daftar hasil panen beserta ID database aslinya.

- **Method**: `GET`
- **URL**: `http://127.0.0.1:8000/api/harvests`
- **Headers**:
  ```http
  Accept: application/json
  Authorization: Bearer 4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39
  ```
- **Response (200 OK)**:
  ```json
  {
      "data": [
          {
              "id": 1,
              "commodity": "TOMAT",
              "weight": "450 kg",
              "harvested_at": "2026-06-14",
              "created_format": "2026-07-07 19:34:12"
          },
          {
              "id": 2,
              "commodity": "PADI",
              "weight": "1500 kg",
              "harvested_at": "2026-07-01",
              "created_format": "2026-07-07 19:34:15"
          }
      ],
      "links": {
          "first": "http://127.0.0.1:8000/api/harvests?page=1",
          "last": "http://127.0.0.1:8000/api/harvests?page=1",
          "prev": null,
          "next": null
      },
      "meta": {
          "current_page": 1,
          "from": 1,
          "last_page": 1,
          "links": [
              {
                  "url": null,
                  "label": "&laquo; Previous",
                  "active": false
              },
              {
                  "url": "http://127.0.0.1:8000/api/harvests?page=1",
                  "label": "1",
                  "active": true
              },
              {
                  "url": null,
                  "label": "Next &raquo;",
                  "active": false
              }
          ],
          "path": "http://127.0.0.1:8000/api/harvests",
          "per_page": 10,
          "to": 2,
          "total": 2
      },
      "success": true,
      "message": "Daftar data hasil panen"
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN TAMPILKAN SEMUA DATA DI SINI]**

---

## 5. Tampilkan Detail Data Spesifik (GET /api/harvests/{id})
Digunakan untuk melihat data panen spesifik berdasarkan ID database-nya.

- **Method**: `GET`
- **URL**: `http://127.0.0.1:8000/api/harvests/1`
- **Headers**:
  ```http
  Accept: application/json
  Authorization: Bearer 4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39
  ```
- **Response (200 OK)**:
  ```json
  {
      "data": {
          "id": 1,
          "commodity": "TOMAT",
          "weight": "450 kg",
          "harvested_at": "2026-06-14",
          "created_format": "2026-07-07 19:34:12"
      }
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN DETAIL DATA DI SINI]**

---

## 6. Update/Ubah Data Panen (PUT /api/harvests/{id})
Digunakan untuk memperbarui data panen spesifik berdasarkan ID database-nya.

- **Method**: `PUT`
- **URL**: `http://127.0.0.1:8000/api/harvests/1`
- **Headers**:
  ```http
  Accept: application/json
  Authorization: Bearer 4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39
  ```
- **Request Body (JSON)**:
  ```json
  {
      "nama_komoditas": "Tomat Super Premium",
      "jumlah_kg": 500,
      "tanggal_panen": "2026-06-14"
  }
  ```
- **Response (200 OK)**:
  ```json
  {
      "data": {
          "id": 1,
          "commodity": "TOMAT SUPER PREMIUM",
          "weight": "500 kg",
          "harvested_at": "2026-06-14",
          "created_format": "2026-07-07 19:34:12"
      },
      "success": true,
      "message": "Data panen berhasil diperbarui"
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN UPDATE DATA DI SINI]**

---

## 7. Hapus Data Panen (DELETE /api/harvests/{id})
Digunakan untuk menghapus rekaman data panen dari sistem berdasarkan ID-nya.

- **Method**: `DELETE`
- **URL**: `http://127.0.0.1:8000/api/harvests/1`
- **Headers**:
  ```http
  Accept: application/json
  Authorization: Bearer 4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39
  ```
- **Response (200 OK)**:
  ```json
  {
      "success": true,
      "message": "Data panen berhasil dihapus."
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN HAPUS DATA DI SINI]**

---

## 8. Filter Berdasarkan Rentang Tanggal (GET /api/harvests?start_date=...&end_date=...)
Digunakan untuk menyaring data panen yang ditampilkan berdasarkan rentang tanggal.

- **Method**: `GET`
- **URL**: `http://127.0.0.1:8000/api/harvests?start_date=2026-06-01&end_date=2026-07-01`
- **Headers**:
  ```http
  Accept: application/json
  Authorization: Bearer 4|Sa6sBVwP8tad0yVBm1zuMCguc5wXULTfyIebXOfva0a9cf39
  ```
- **Response (200 OK)**:
  ```json
  {
      "data": [
          {
              "id": 1,
              "commodity": "TOMAT",
              "weight": "450 kg",
              "harvested_at": "2026-06-14",
              "created_format": "2026-07-07 19:34:12"
          }
      ],
      "success": true,
      "message": "Daftar data hasil panen"
  }
  ```

> **[TEMPATKAN SCREENSHOT POSTMAN FILTER TANGGAL DI SINI]**
