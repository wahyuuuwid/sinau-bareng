# Sinau Bareng

Sinau Bareng adalah platform pembelajaran kolaboratif berbasis web yang menyediakan **bank soal dan materi pembelajaran** untuk mahasiswa dan dosen.  
Aplikasi ini memungkinkan pengguna untuk berbagi materi, mencari referensi belajar, serta membuat soal latihan otomatis menggunakan **AI**.

Sistem ini dirancang sebagai **pendukung pembelajaran (supporting learning system)** dan bukan pengganti Learning Management System (LMS) resmi kampus.

---

## 📚 Latar Belakang

Mahasiswa sering kesulitan mencari materi pembelajaran dan soal latihan yang relevan dalam satu tempat yang terstruktur.  
Sinau Bareng hadir sebagai solusi dengan menyediakan:

- Repository materi pembelajaran
- Bank soal latihan
- Sistem validasi oleh dosen
- Generate soal otomatis berbasis AI

Dengan sistem ini, proses belajar menjadi lebih **kolaboratif, terstruktur, dan efisien**.

---

## 🎯 Tujuan Sistem

Tujuan utama dari Sinau Bareng adalah:

- Menyediakan platform berbagi **materi dan bank soal**
- Membantu mahasiswa berlatih melalui **soal latihan**
- Mendukung dosen dalam **memvalidasi konten akademik**
- Menyediakan fitur **generate soal otomatis berbasis AI**
- Menjadi **pelengkap LMS kampus**

---

## 👥 Jenis Pengguna

Sistem memiliki tiga jenis pengguna utama.

### 1️⃣ Mahasiswa
Mahasiswa merupakan pengguna utama sistem.

Fitur yang tersedia:
- Registrasi dan login
- Mengunggah materi pembelajaran
- Mencari dan mengunduh materi
- Generate soal otomatis menggunakan AI
- Memberi rating pada materi
- Melaporkan konten bermasalah

---

### 2️⃣ Dosen
Dosen berperan sebagai validator akademik.

Fitur yang tersedia:
- Memvalidasi materi yang diunggah mahasiswa
- Meninjau dan menyetujui soal hasil AI
- Memberikan feedback pada konten

---

### 3️⃣ Admin
Admin bertugas mengelola sistem.

Fitur yang tersedia:
- Mengelola data pengguna
- Moderasi konten
- Menghapus konten bermasalah
- Mengatur notifikasi validasi dosen

---

## ⚙️ Fitur Utama

### 🔐 Manajemen Akun
- Registrasi
- Login
- Logout
- Manajemen profil

---

### 📂 Manajemen Materi
- Upload materi pembelajaran
- Pengelompokan berdasarkan mata kuliah
- Pencarian materi
- Download materi

---

### 🤖 Generate Soal AI
Sistem dapat menghasilkan soal latihan secara otomatis dari materi menggunakan **AI (Google Gemini API)**.

Jenis soal yang didukung:
- Pilihan ganda
- Benar / salah
- Isian singkat

⚠️ Soal yang dihasilkan AI **harus divalidasi oleh dosen sebelum dipublikasikan.**

---

### 📊 Bank Soal
Soal yang sudah divalidasi akan disimpan dalam bank soal dan dapat digunakan oleh mahasiswa lain untuk latihan.

---

### ⭐ Rating & Laporan Konten
Pengguna dapat:
- Memberi rating pada materi
- Melaporkan konten yang tidak relevan

---

### 🛠 Moderasi Admin
Admin dapat:
- Menghapus konten bermasalah
- Mengelola laporan
- Mengelola pengguna


---

## 💻 Arsitektur & Teknologi yang Digunakan

### Backend & Fronted
- Laravel (v.12.0)
- Blade Template Engine
- Bootstrap / Tailwind CSS

### Database
- MySQL

### AI Integration
- Google Gemini API

---

## 🔒 Batasan Sistem

- Ukuran file maksimal: **5 MB**
- Format file yang didukung:
  - `.pdf`
  - `.docx`
  - `.pptx`
  - `.jpg`
  - `.png`
- Hanya pengguna dengan **email institusi** yang dapat mengakses sistem
- Soal AI **tidak dapat dipublikasikan tanpa validasi dosen**

---

## 🚀 Cara Menjalankan Project
Sebelum menjalankan project ini, pastikan beberapa software berikut sudah terinstall di laptop/komputer Anda:

- **Composer** (versi 2.x) - [Download Composer](https://getcomposer.org/download/)
- **XAMPP** - [Download XAMPP](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe/download)
- **Node.js** - [Download Node.js](https://nodejs.org)

Cek instalasi dengan perintah berikut:

```bash
php -v
composer -v
node -v
```


### 1️⃣ Clone Repository
```bash
git clone https://github.com/wahyuuuwid/sinau-bareng.git
```

### 2️⃣ Masuk Folder Project
```bash
cd sinau-bareng
```

### 3️⃣ Install Dependencies Backend
```bash
composer install
```

### 4️⃣ Install Dependency Frontend
```bash
npm install
```

### 5️⃣ Copy File Environment
```bash
cp .env.example .env
```

### 6️⃣ Generate App Key
```bash
php artisan key:generate
```

### 7️⃣ Konfigurasi Database

Edit file **.env** lalu sesuaikan konfigurasi database:

```env
DB_DATABASE=sinau_bareng
DB_USERNAME=root
DB_PASSWORD=
```

### 8️⃣ Jalankan Migration
```bash
php artisan migrate
```

### 9️⃣ Build Asset Frontend

```bash
npm run build
```

### 🔟 Menjalankan Server
```bash
composer run dev
```
Aplikasi akan berjalan di:

```
http://127.0.0.1:8000
```
---

## 📂 Struktur Project

Project ini menggunakan struktur standar **Laravel MVC**:

- **app/Models** → Model database
- **app/Http/Controllers** → Controller logic
- **resources/views** → Blade template (UI)
- **routes/web.php** → Routing web
---

## 👨‍💻 Tim Pengembang

- **Wahyu Widodo** - *Project Manager & UI/UX Design* • [wahyuuwid](https://github.com/wahyuuuwid)
- **Naufal Labib Asyidiq** - *Backend Developer*  • [Noapllabib06](https://github.com/Noapllabib06)
- **Dzaki Khothir** - *Backend Developer* • [zakverse](https://github.com/zakverse)
- **Lahra Budi Saputra** - *Frontend Developer* • [RAAZ-ID](https://github.com/RAAZ-ID)
- **Fauza Kaizaku Setiawan** - *Frontend Developer* • [kaimiongmiong012](https://github.com/kaimiongmiong012)
- **Rafi Maheswara** - *Frontend Developer* • [RafiMaheswara](https://github.com/RafiMaheswara)

#

<div align="center">
  
**S1 Teknik Informatika** · **Fakultas Informatika** · **Telkom University**

<img src="https://img.shields.io/badge/Telkom University Purwokerto-8B0000?style=for-the-badge&logo=react&logoColor=white" />

</div>


