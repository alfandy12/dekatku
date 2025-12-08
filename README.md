<div align="center">
  <!-- <a href="https://github.com/alfandy12/dekatku">
    <img src="https://github.com/alfandy12/dekatku/blob/main/public/favicon.svg" alt="Logo DekatKu" width="120" height="120">
  </a> -->
  <h1 align="center"><b>DekatKu</b></h1>

  <p align="center">
    <strong>Platform Discovery Hyperlocal & Asisten Belanja Berbasis AI</strong>
    <br />
    <em>"Temukan apa saja di sekitarmu, tanyakan pada AI."</em>
<br /><br />
<a href="https://origin.web.id/" target="_blank">
  <img src="https://img.shields.io/badge/🚀_Demo-Live-2ea44f?style=for-the-badge" alt="Live Demo" height="40"/>
</a>
&nbsp; &nbsp;
<a href="https://github.com/alfandy12/dekatku/issues/9" target="_blank">
  <img src="https://img.shields.io/badge/Video-Watch-FF0000?style=for-the-badge&logo=youtube&logoColor=white" alt="Video Demo" height="40"/>
</a>
  </p>

  <p align="center">
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel" alt="Laravel 12"></a>
    <a href="https://react.dev"><img src="https://img.shields.io/badge/React-Inertia-61DAFB?style=flat&logo=react" alt="React"></a>
    <a href="https://filamentphp.com"><img src="https://img.shields.io/badge/Admin-Filament-F28D1A?style=flat&logo=php" alt="Filament"></a>
    <a href="#"><img src="https://img.shields.io/badge/AI-Agent_Integrated-blueviolet?style=flat" alt="AI Agent"></a>
    <a href="#"><img src="https://img.shields.io/badge/License-MIT-green?style=flat" alt="License"></a>
  </p>
</div>

<div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;" align="center">
        <img width="900" alt="Image" src="https://github.com/user-attachments/assets/8a638696-1d4e-4894-8d22-2443a7eaef9e" />
</div>


<h2>💡 Project Overview</h2>

Dekatku adalah platform direktori berbasis lokasi yang menghubungkan masyarakat (wisatawan/pengunjung) dengan UMKM dan Penyedia Jasa Lokal. Aplikasi ini membantu menemukan usaha rumahan yang biasanya sulit ditemukan di mesin pencari umum. Dengan integrasi Geolocation dan AI, Dekatku memberikan rekomendasi usaha terdekat secara cerdas dan akurat.

---

<h2>🎯 Project Goals & Motivation</h2>

<p>
  DekatKu hadir untuk menjembatani kesenjangan antara kebutuhan pengguna akan produk spesifik dengan keberadaan UMKM lokal yang seringkali tidak terdeteksi oleh radar digital konvensional.
</p>

<h3>1. The Problem</h3>
<p>
  Saat ini, mencari produk atau jasa lokal yang spesifik seringkali menemui kendala:
</p>
<ul>
  <li>
    <strong>🔍 Hasil Pencarian Tidak Relevan:</strong> Mesin pencari umum sering menampilkan artikel atau portal berita, bukan lokasi fisik toko yang menjual barang tersebut.
  </li>
  <li>
    <strong>🏠 Invisibilitas Usaha Rumahan:</strong> Sulitnya menemukan usaha kecil atau personal (UMKM) yang beroperasi dari rumah tanpa toko fisik yang mencolok.
  </li>
  <li>
    <strong>📄 Kurangnya Informasi Spesifik:</strong> Minimnya detail mengenai ketersediaan produk atau layanan jasa secara <em>real-time</em> di lokasi terdekat.
  </li>
</ul>

<h3>2. The Objectives</h3>
<p>
  Berdasarkan permasalahan di atas, DekatKu memiliki tujuan utama:
</p>
<ul>
  <li>
    <strong>📢 Demokratisasi Akses Usaha:</strong> Menyediakan direktori gratis dan terbuka bagi seluruh pelaku usaha (baik produk maupun jasa) untuk mendaftar dan mempromosikan layanan mereka.
  </li>
  <li>
    <strong>📍 Discovery Tercepat:</strong> Mempermudah pengguna menemukan kebutuhan mereka dalam radius terdekat, menghemat waktu dan biaya transportasi.
  </li>
  <li>
    <strong>📈 Meningkatkan Visibilitas UMKM:</strong> Mengangkat potensi usaha rumahan (non-fisik) agar dapat bersaing dan mudah ditemukan oleh tetangga atau masyarakat sekitar.
  </li>
  <li>
    <strong>🤖 Pencarian Cerdas Berbasis AI:</strong> Menawarkan pengalaman pencarian yang lebih manusiawi dan akurat melalui integrasi AI Agent, yang memahami konteks kebutuhan pengguna, bukan sekadar pencarian kata kunci kaku.
  </li>
</ul>

---

## ✨ Key Features

#### 1. 🌍 Geolocation & Peta Interaktif
- Deteksi lokasi real-time untuk akurasi tinggi.
- Integrasi **Leaflet.js** (gratis, open-source, ringan).
- Menampilkan rute dari pengguna ke lokasi usaha.

#### 2. 🤖 Integrasi AI (Smart Recommendation)
- Menggunakan **Groq AI** sebagai mesin LLM super cepat.
- Chatbot konsultasi pencarian dengan bahasa natural.
- Rekomendasi berdasarkan jarak dan relevansi usaha.

#### 3. 🏪 Direktori Komprehensif
- UMKM produk: makanan, kerajinan, suvenir.
- Penyedia jasa lokal: reparasi, kebersihan, makeup, dll.
- Mendukung usaha rumahan tanpa toko fisik.

#### 4. 🔐 Manajemen Data & Console (Filament Panel)

##### Admin Console
- Dashboard analitik.
- Moderasi data usaha (approve/reject listing).
- Manajemen user & konfigurasi.

##### Panel Console (Mitra)
- Manajemen profil usaha.
- Upload foto.
- **Pinpoint lokasi** menggunakan peta Leaflet (klik/geser marker).

---

## 📸 Interface Showcase

Berikut adalah tampilan antarmuka aplikasi DekatKu berdasarkan hak akses pengguna:

### 1. User / Pengunjung (Discovery Mode)
Tampilan utama bagi pengguna untuk mencari produk, melihat peta, dan berinteraksi dengan AI Assistant.

<br>
      <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;" align="center">
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/8a638696-1d4e-4894-8d22-2443a7eaef9e" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/c4ab1f2d-f05e-4a60-b255-8902902124d5" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/623fe0a3-ae6b-40b4-83fc-15451b45320f" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/c6f4cc40-3ea8-4cb9-a687-ff8c814817e5" />
      </div>

### 2. Dashboard Admin (Super Admin)
Pusat kontrol untuk moderasi data usaha, manajemen kategori, dan pemantauan statistik sistem.

<br>
      <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;" align="center">
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/2a683fb3-7981-4ca6-ae51-1bf06f87a9e3" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/3a688f3b-2a5d-4383-88cc-49015e9a3359" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/81ebed40-2279-47f6-abd5-20a1edb3689c" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/e4f91160-299a-4b05-81f1-e771216edbc6" />
         <img width="400" alt="image" src="https://raw.githubusercontent.com/alfandy12/dekatku/main/public/docs/img/admin.png" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/b0aa1108-9ef5-44cf-b358-9be5978aae28" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/11174eb1-f4c8-482b-8621-0974f822e407" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/9d75b7ba-4e5f-4384-aa0b-9c36237f9d8d" />
      </div>

### 3. Dashboard Mitra (Store Console)
Panel khusus bagi pemilik usaha (UMKM) untuk mengelola profil toko, produk, dan titik lokasi di peta.

<br>
      <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; align-items: center;" align="center">
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/a113fdb3-d11c-4fad-abe6-025ba0a19bd1" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/8f8d296e-fe0c-4eea-879a-7bc3ab56674e" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/141f6180-3f07-4242-8fdb-6734820d83dd" />
         <img width="400" alt="image" src="https://github.com/user-attachments/assets/1882ba86-86d2-4eb3-8d92-027daa05db20" />
      </div>

---

## 🔄 How It works

#### A. Alur Pengguna
1. Pengguna membuka web → mengizinkan akses lokasi.
2. Sistem menghitung jarak terdekat (Laravel backend).
3. Pencarian:
   - Filter manual kategori / produk / jasa.
   - AI (chatbot) untuk query natural.
4. Pengguna memilih usaha → ditampilkan rute di peta.

#### B. Alur Panel Console (Mitra)
1. Registrasi & verifikasi akun.
2. Login ke Panel Console.
3. Input data usaha dan upload foto.
4. Menentukan lokasi usaha via Leaflet Map.
5. Data dikirim untuk approval Admin Console.

---

<h2>🛠 Tech Stack</h2>

<p>
  DekatKu dibangun dengan arsitektur <em>Monolithic Modern</em> untuk memastikan performa tinggi namun tetap mudah dikembangkan (Developer Experience yang baik).
</p>

| Komponen | Teknologi | Mengapa Kami Memilihnya? |
| :--- | :--- | :--- |
| **Backend** | [**Laravel 12**](https://laravel.com) | Framework PHP paling modern, aman, dan memiliki ekosistem packages yang sangat matang. |
| **Frontend** | [**React.js**](https://react.dev) + [**Inertia.js**](https://inertiajs.com) | Memberikan pengalaman *Single Page Application* (SPA) tanpa kerumitan memisahkan API dan Client secara total. |
| **Styling** | [**Tailwind CSS**](https://tailwindcss.com) + [**Shadcn UI**](https://ui.shadcn.com) | Styling utility-first yang mempercepat pembuatan antarmuka responsif, konsisten, dan modern. |
| **Admin Panel** | [**FilamentPHP v3**](https://filamentphp.com) | Mempercepat pembuatan dashboard admin dan manajemen database hingga 10x lipat. |
| **AI Engine** | [**Groq Cloud**](https://groq.com) | Infrastruktur LLM tercepat saat ini (LPU Inference) untuk respons chat yang *real-time*. |
| **Maps** | [**Leaflet.js**](https://leafletjs.com) | Alternatif Google Maps yang Open Source (Gratis), ringan, dan sangat kustomisasi. |
| **Database** | [**MySQL**](https://www.mysql.com) | Database relasional yang stabil dan andal untuk menangani data transaksi dan lokasi. |

---

## 🚀 How to run

### **System Requirements**
- **PHP** >= 8.2 (Wajib untuk Laravel 12)
- **Composer** (Dependency Manager PHP)
- **Node.js** & **NPM** (Untuk compile aset React)
- **MySQL** (Database)
- **API Key Groq** (Dapatkan di [console.groq.com](https://console.groq.com))

### **1. Clone Repository**
```bash
git clone https://github.com/alfandy12/dekatku.git
cd dekatku
```

### **2. Install Backend (Composer)**
```bash
composer install
```

### **3. Setup Environment & API Key**
```bash
cp .env.example .env
```
Edit file **.env**:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dekatku_db
DB_USERNAME=root
DB_PASSWORD=

GROQ_API_KEY=gsk_xxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

### **4. Application Setup & Database Migrations**
```bash
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
```

### **5. Install Frontend (React)**
```bash
npm install
npm run dev
```

### **6. Run Server**
```bash
php artisan serve
```
---

## 🔗 Access & Accounts Demo

Berikut adalah tautan dan kredensial yang dapat digunakan untuk menguji aplikasi **DekatKu**.

### 1. URL Aplikasi
| Halaman | URL | Keterangan |
| :--- | :--- | :--- |
| **Web App (Pengunjung)** | [http://localhost:8000](http://localhost:8000) | Halaman utama pencarian produk & chat AI. |
| **Panel Admin** | [http://localhost:8000/admin](http://localhost:8000/admin) | Dashboard untuk Super Admin (Moderasi & Data Master). |
| **Panel Mitra (Console)** | [http://localhost:8000/console](http://localhost:8000/console) | Dashboard untuk Pemilik Toko (Manajemen Produk & Toko). |

### 2. Kredensial Login
Gunakan akun berikut untuk masuk ke sistem:

| Role | Email | Password | Login Via |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `admin@dekatku.id` | `12345678` | [/admin](http://localhost:8000/admin) |
| **Mitra (Toko Demo)** | `test1@example.com` | `password` | [/console](http://localhost:8000/console) |
| **Mitra (Alternatif)** | `test2@example.com` | `password` | [/console](http://localhost:8000/console) |

> **Catatan:**
> * **Super Admin:** Memiliki hak akses penuh ke seluruh sistem.
> * **Mitra Toko:** Masuk melalui `/console` (bukan `/admin`) atau dapat melalui login biasa di `/login` lalu akses menu Dashboard.

---

## 👥 Team Information

**Origin Team:**
* [**@alfandy12**](https://github.com/alfandy12) (Team Lead)
* [**@ferdi-alf**](https://github.com/ferdi-alf) (Developer)
* [**@arttVinci**](https://github.com/arttVinci) (Developer)
* [**@ridhsuki**](https://github.com/Ridhsuki) (Documentation)

---

## 🤝 Contributions

bisa berkontribusi dengan cara:

- **Membuat Pull Request** untuk pengembangan fitur baru atau perbaikan bug yang ada.
- **Menambahkan Issue** jika Anda menemukan bug atau memiliki ide untuk fitur baru. [Buka Issue Baru di sini](https://github.com/alfandy12/dekatku/issues/new).
- **Fork repositori** dan kirimkan perubahan Anda untuk membantu mengembangkan proyek ini.
- **Memberikan Bintang (Star)** pada repositori ini untuk mendukung pengembangan proyek.
 
---

<h2>📚 Others</h2>

Berikut adalah dokumen terkait pengembangan proyek DekatKu:

  * **Project Planning:** [Google Docs - Perencanaan Sistem](https://docs.google.com/document/d/1cfyK1IEp7QWCWGjvf5Z-vEQ3a56NhXHrvp1Lzs2hAOk/edit?usp=sharing)
  * **ER Diagram (ERD):** [GitHub Issues - Database Schema](https://github.com/alfandy12/dekatku/issues/8)
  * **Hackathon Submission:** [Imphnen Hackathon Team Page](https://hackathon.imphnen.dev/teams/a0e4ff56-888d-47d8-a0cb-4d38c6676567/submission)

---

<div align="center" style="background-color: #ffffff; padding: 20px; border-radius: 20px; width: fit-content; margin: 0 auto; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
  <h3 style="color: #333; margin-top: 0;">Supported By</h3>
  
  <div style="display: flex; gap: 25px; justify-content: center; align-items: center; flex-wrap: wrap; background-color: #efefef; padding: 10px 0;">
    <a href="https://www.facebook.com/groups/1032515944638255" target="_blank" style="display: flex; align-items: center;">
      <img src="https://hackathon.imphnen.dev/images/imphnen-logo.svg" alt="Imphnen Community" height="50"/>
    </a>
    <a href="https://www.kolosal.ai/" target="_blank" style="display: flex; align-items: center;">
      <img src="https://avatars.githubusercontent.com/u/127637382?s=200&v=4" alt="Kolosal AI" height="58" style="margin-top: -2px;"/>
    </a>
  </div>

  <p style="color: #555; margin-bottom: 0; margin-top: 15px;">
    <em>Big thanks to <b>Imphnen</b> & <b>Kolosal AI</b> for the support!</em>
  </p>
</div>
<br>

---

<h5 align="center">
  Dibuat dengan ❤️ dan ☕ oleh Origin Team
</h5>
 