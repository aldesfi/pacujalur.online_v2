# Pacujalur Digital - Sistem Manajemen Hasil Pertandingan Real-Time

[![Laravel Version](https://img.shields.io/badge/Laravel-v11.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS Version](https://img.shields.io/badge/Tailwind_CSS-v3.x-06B6D4?logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Pacujalur Digital** adalah aplikasi berbasis web yang dirancang khusus untuk mempermudah dalam mengelola, memantau, dan memperbarui hasil pertandingan secara langsung (*real-time*) di arena Festival Pacu Jalur.

Aplikasi ini menggunakan pendekatan Hybrid SPA (Single Page Application) yang mengombinasikan keandalan **Laravel** di backend dengan interaktivitas **Vanilla JavaScript & Tailwind CSS** di frontend, memastikan sinkronisasi data pemenang per hilir berjalan cepat tanpa membebani dengan *page reload*.

---

## 🚀 Fitur Utama

* **Dashboard Praktis:** Desain berbasis *Segmented Controls* (Tombol Tab Aktif) yang memungkinkan memperbarui status pertandingan dan pemenang jalur hanya dengan 1 kali klik.
* **Sinkronisasi Data Otomatis (Auto-Refresh):** Halaman memperbarui data pertandingan setiap 5 detik di latar belakang agar data dan papan skor penonton selalu sinkron.
* **Pencarian Instan (Live Client-side Filter):** Pencarian nomor hilir atau babak dilakukan langsung di browser tanpa memicu *lag* pada server.
* **Manajemen Pemenang Otomatis:** Memilih pemenang (Jalur Kiri/Kanan) otomatis mengubah status pertandingan menjadi "Selesai".
* **Arsitektur Eager Loading:** Mengoptimalkan kueri database relasional antara Data Aduan, Jalur, dan asal Asal untuk mencegah masalah performa *N+1 query*.

---

## 🛠️ Tech Stack

* **Backend:** Laravel 11.x
* **Frontend:** Tailwind CSS, JavaScript Async/Fetch API, FontAwesome Icons
* **Database:** MySQL / PostgreSQL (didukung oleh Laravel Eloquent ORM)

---

## 📦 Alur Data Sistem

```text
[ Database ] 💡 (Eager Loading)
      │
      ├──> [ API List Endpoint ] ──(Setiap 5 Detik)──> [ JavaScript Array ]
                                                             │
                                                     (Live Filter Client)
                                                             │
                                                       [ Render DOM ]
                                                             │
[ Database ] <─── [ API Update ] <─── (Fetch POST) <─── [ Tombol Simpan Juri ]
