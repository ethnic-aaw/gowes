# Product Requirements Document (PRD)
## Website Landing Page MGC (Manggar Gowes Community)

**Versi Dokumen:** 1.0
**Tanggal:** 15 September 2026
**Status:** Draft

---

## 1. Latar Belakang

**MGC (Manggar Gowes Community)** membutuhkan sebuah website resmi yang berfungsi sebagai etalase digital sekaligus pusat informasi kegiatan komunitas. Saat ini informasi kegiatan, dokumentasi, dan berita komunitas kemungkinan masih tersebar di media sosial (WhatsApp Group, Instagram, dll) sehingga sulit diarsipkan dan diakses secara terstruktur oleh anggota maupun calon anggota.

Website ini akan menjadi halaman resmi MGC yang menampilkan profil komunitas, riwayat kegiatan (event gowes), dan berita terbaru, dengan sistem admin agar pengurus komunitas dapat mengelola konten secara mandiri tanpa bergantung pada developer.

## 2. Tujuan Produk

1. Menyediakan landing page profesional sebagai identitas resmi MGC (Manggar Gowes Community).
2. Menampilkan **histori kegiatan** (event yang sudah berlangsung) secara rapi dan terdokumentasi.
3. Menampilkan **berita terbaru** komunitas di halaman utama.
4. Memudahkan pengurus (admin) untuk menambah, mengubah, dan menghapus konten (kegiatan & berita) melalui panel admin, tanpa perlu mengubah kode program.
5. Meningkatkan citra dan eksistensi komunitas di mata publik/calon anggota baru.

## 3. Target Pengguna

| Peran | Deskripsi |
|---|---|
| **Pengunjung Umum (Visitor)** | Masyarakat umum/calon anggota yang ingin melihat info komunitas, kegiatan, dan berita. |
| **Anggota Komunitas** | Anggota terdaftar yang mengikuti update kegiatan komunitas. |
| **Admin** | Pengurus komunitas yang mengelola konten website (kegiatan, berita, galeri, dsb). |
| **Super Admin (opsional)** | Mengelola akun admin lain dan pengaturan sistem tingkat lanjut. |

## 4. Ruang Lingkup (Scope)

### 4.1 In-Scope
- Landing page publik (tanpa perlu login)
- Halaman utama menampilkan histori kegiatan & berita terbaru
- Halaman detail kegiatan & detail berita
- Panel admin (CMS) untuk CRUD konten
- Autentikasi admin (login/logout)
- Upload gambar/dokumentasi kegiatan

### 4.2 Out-of-Scope (Fase 1)
- Sistem pendaftaran/keanggotaan online dengan pembayaran
- Forum diskusi/komentar antar anggota
- Aplikasi mobile native
- Integrasi tracking rute GPS (Strava, dsb) — dapat menjadi rencana fase berikutnya

## 5. Struktur Halaman (Sitemap)

```
Beranda (Home)
├── Berita Terbaru (ringkasan + link ke detail)
├── Histori Kegiatan (list kegiatan terbaru/terlaksana)
├── Tentang Komunitas
├── Galeri Foto
├── Kontak / Media Sosial
└── (Admin) Login
    └── Dashboard Admin
        ├── Kelola Kegiatan (CRUD)
        ├── Kelola Berita (CRUD)
        ├── Kelola Galeri
        └── Kelola Akun Admin (Super Admin)
```

## 6. Kebutuhan Fungsional

### 6.1 Halaman Publik
| ID | Fitur | Deskripsi |
|---|---|---|
| F-01 | Halaman Utama | Menampilkan hero banner, ringkasan komunitas, daftar berita terbaru (3–5 teratas), dan daftar histori kegiatan terbaru. |
| F-02 | Detail Berita | Menampilkan isi lengkap satu berita: judul, tanggal, foto, isi konten. |
| F-03 | Detail Kegiatan | Menampilkan detail kegiatan: nama event, tanggal, lokasi/rute, deskripsi, dokumentasi foto, jumlah peserta (opsional). |
| F-04 | Arsip Histori Kegiatan | Daftar seluruh kegiatan yang pernah dilaksanakan, dapat difilter berdasarkan tahun/bulan. |
| F-05 | Galeri Foto | Kumpulan foto dokumentasi dari berbagai kegiatan. |
| F-06 | Tentang Kami | Profil, visi-misi, struktur pengurus komunitas. |
| F-07 | Kontak | Form kontak / link media sosial (Instagram, WhatsApp, dsb). |

### 6.2 Panel Admin (CMS)
| ID | Fitur | Deskripsi |
|---|---|---|
| A-01 | Login Admin | Autentikasi menggunakan username/email & password (session/JWT). |
| A-02 | Kelola Kegiatan | Tambah/edit/hapus kegiatan: judul, tanggal, lokasi, deskripsi, upload foto, status (akan datang/selesai). |
| A-03 | Kelola Berita | Tambah/edit/hapus berita: judul, tanggal publish, kategori, isi (rich text editor), thumbnail. |
| A-04 | Kelola Galeri | Upload/hapus foto dan mengelompokkan ke kegiatan tertentu. |
| A-05 | Manajemen Akun Admin | (Super Admin) menambah/menonaktifkan akun admin lain. |
| A-06 | Dashboard Ringkasan | Statistik singkat: jumlah kegiatan, jumlah berita, aktivitas terakhir. |

## 7. Kebutuhan Non-Fungsional

- **Responsive Design**: tampil baik di desktop, tablet, dan mobile.
- **Performa**: waktu muat halaman utama < 3 detik pada koneksi normal.
- **Keamanan**: password admin di-hash (bcrypt/argon2), proteksi terhadap SQL Injection & XSS, validasi input di sisi server.
- **SEO Friendly**: struktur HTML semantik, meta tag, sitemap.xml untuk halaman publik.
- **Skalabilitas**: arsitektur backend memisahkan API (Golang) dari panel admin (PHP) agar mudah dikembangkan.
- **Maintainability**: kode terstruktur dengan pemisahan layer (routing, controller, model/database).

## 8. Arsitektur Teknis (Usulan)

Karena disebutkan stack yang digunakan adalah **HTML, PHP, dan Golang**, berikut usulan pembagian peran teknologi agar masing-masing dipakai sesuai kekuatannya:

| Layer | Teknologi | Fungsi |
|---|---|---|
| **Frontend (Publik)** | HTML, CSS, JavaScript (bisa + template engine PHP) | Menampilkan landing page, halaman berita & kegiatan ke pengunjung. Bisa server-side render sederhana via PHP untuk kemudahan SEO. |
| **Panel Admin (CMS)** | PHP (mis. framework ringan seperti Laravel/CodeIgniter atau native PHP) | Form input, upload gambar, autentikasi admin, CRUD konten — cocok karena PHP cepat untuk membangun panel admin. |
| **Backend API** | Golang (Go) | Menyediakan REST API (mis. `/api/kegiatan`, `/api/berita`) yang dikonsumsi oleh halaman publik (HTML/JS) secara dinamis, menangani logic performa tinggi, autentikasi token (JWT), dan proses data. |
| **Database** | MySQL / PostgreSQL | Menyimpan data kegiatan, berita, galeri, dan akun admin. |
| **Storage** | Local storage/server atau cloud storage (mis. untuk foto) | Menyimpan file upload gambar/dokumentasi. |

**Alur singkat:**
1. Halaman publik (HTML/JS) memanggil **REST API Golang** untuk menampilkan data berita & kegiatan secara dinamis (fetch/AJAX).
2. Admin login dan mengelola konten melalui **panel PHP**, yang menulis data ke database yang sama.
3. Golang API membaca data yang sudah diinput oleh PHP dari database tersebut untuk ditampilkan ke publik.

> Catatan: Pembagian ini bisa disesuaikan sesuai keahlian tim — misalnya seluruhnya bisa dibangun di Golang saja (API + admin), namun karena PHP disebutkan sebagai bagian stack, pendekatan di atas memanfaatkan PHP khusus untuk kemudahan pengembangan panel admin/CMS.

## 9. Skema Data (Draft)

**Tabel `kegiatan`**
- id, judul, tanggal, lokasi, deskripsi, foto_cover, status (`akan_datang` / `selesai`), created_at, updated_at

**Tabel `berita`**
- id, judul, slug, kategori, isi, thumbnail, tanggal_publish, penulis (admin_id), created_at, updated_at

**Tabel `galeri`**
- id, kegiatan_id (FK), url_foto, caption

**Tabel `admin`**
- id, nama, email/username, password (hash), role (`admin`/`super_admin`), created_at

## 10. Wireframe Halaman Utama (Deskripsi)

```
┌─────────────────────────────────────────┐
│ HEADER: Logo Komunitas | Menu Navigasi   │
├─────────────────────────────────────────┤
│ HERO BANNER: Foto/slogan komunitas       │
├─────────────────────────────────────────┤
│ BERITA TERBARU                           │
│ [Card] [Card] [Card]   (3 berita teratas)│
├─────────────────────────────────────────┤
│ HISTORI KEGIATAN                         │
│ [Card kegiatan 1] [Card kegiatan 2] ...  │
│ (tombol "Lihat Semua Kegiatan")          │
├─────────────────────────────────────────┤
│ GALERI FOTO SINGKAT                      │
├─────────────────────────────────────────┤
│ FOOTER: Kontak, Sosial Media, Copyright  │
└─────────────────────────────────────────┘
```

## 11. User Flow Utama

**Pengunjung:**
1. Buka website → lihat halaman utama (berita + histori kegiatan)
2. Klik salah satu berita/kegiatan → lihat halaman detail
3. (Opsional) klik kontak/sosial media untuk gabung komunitas

**Admin:**
1. Login ke `/admin`
2. Pilih menu "Kegiatan" atau "Berita"
3. Tambah/edit data + upload foto
4. Simpan → data otomatis tampil di halaman publik

## 12. Metrik Keberhasilan (Success Metrics)

- Jumlah pengunjung unik per bulan meningkat.
- Waktu admin untuk publish 1 kegiatan/berita baru < 5 menit.
- Tidak ada laporan bug kritis (data gagal tampil) dalam 1 bulan setelah rilis.
- Halaman utama berhasil menampilkan histori kegiatan & berita terbaru secara real-time setelah admin input data.

## 13. Rencana Tahapan Pengembangan (Milestone)

| Fase | Deskripsi | Estimasi |
|---|---|---|
| 1 | Desain UI/UX (wireframe & mockup halaman) | 1 minggu |
| 2 | Setup database & struktur backend (Golang API + PHP admin) | 1–2 minggu |
| 3 | Pengembangan halaman publik (HTML + integrasi API) | 2 minggu |
| 4 | Pengembangan panel admin (PHP CMS) | 2 minggu |
| 5 | Testing (fungsional, responsif, keamanan dasar) | 1 minggu |
| 6 | Deployment & rilis | 3–5 hari |

## 14. Risiko & Mitigasi

| Risiko | Mitigasi |
|---|---|
| Kompleksitas menggabungkan 2 bahasa backend (PHP & Golang) | Definisikan kontrak API yang jelas di awal (dokumentasi endpoint), gunakan database yang sama sebagai titik temu. |
| Admin lupa password / disalahgunakan akun | Fitur reset password & log aktivitas admin. |
| Upload gambar besar memperlambat server | Kompresi/resize otomatis saat upload, batasi ukuran file. |

---

**Lampiran:** Dokumen ini dapat dikembangkan lebih lanjut dengan menambahkan mockup visual (Figma) dan dokumentasi API (Swagger/OpenAPI) sebelum masuk tahap development.
