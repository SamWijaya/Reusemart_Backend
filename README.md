# Implementasi Keamanan Data untuk Platform E-Commerce

Repositori ini berisi implementasi *coursework* (tugas kuliah) untuk mata kuliah **Keamanan Data**. Proyek ini mensimulasikan *backend* platform E-Commerce yang aman, dengan fokus pada otentikasi, kontrol akses, enkripsi, dan kepatuhan terhadap regulasi privasi.

## 📋 Daftar Komponen Tugas

Proyek ini telah memenuhi poin-poin penilaian berikut:

### Implementasi Teknis
- **Otentikasi Aman**: Sistem login dengan implementasi 2FA sederhana (OTP via Email/Log).
- **Enkripsi**: Password pengguna di-hash menggunakan **Bcrypt/Argon2**.
- **Kontrol Akses (RBAC)**: Pemisahan peran yang jelas untuk `Admin`, `Seller`, dan `Customer`.
- **Keamanan API**: Proteksi REST API menggunakan **JWT (JSON Web Tokens)** dan *Rate Limiting*.
- **Monitoring Keamanan**: Sistem *logging* untuk melacak upaya login gagal dan akses API sensitif.
