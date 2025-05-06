# Janji

Saya Shizuka Maulia Putri NIM 2308744 mengerjakan Tugas Praktikum 9 dalam mata kuliah DPBO untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.


---

# ERD
![image](https://github.com/user-attachments/assets/11f3f3a3-0cbe-464b-91b9-1a2ce0a35bf7)

Relasi antara kedua entitas ini bersifat one-to-many, artinya satu departemen dapat memiliki banyak mahasiswa, tetapi setiap mahasiswa hanya terdaftar di satu departemen. Relasi ini diimplementasikan melalui kolom id_department di tabel students yang merujuk ke kolom id di tabel departments.

---

# Penjelasan MVC dan Alur Kerjanya

1. Tampilan Awal
- Ketika pertama kali membuka web akan langsung mengarah ke index.php  → Tidak ada request parameter
- Sistem panggil StudentController::index()
- Controller minta data ke Model: Student::getStudent()
- Model ambil data dari database (SELECT * FROM students)
- Controller kirim data ke View
- View akan menampilkan:
- Form kosong untuk input data baru (bagian atas)
- Tabel list student dengan data dari database (bagian bawah)

2. Menambah Data
- User isi form → Klik tombol Submit 
- Form kirim data via “POST” ke index.php
- Sistem menerima parameter submit → Panggil StudentController::add()
- Controller ambil data dari $_POST → Minta Model simpan data:
- Student::addStudent($data);  
- Model jalankan query INSERT ke database
- Redirect ke index.php → Halaman ter-refresh, data baru muncul di list.

3. Edit Data
- User klik tombol Edit di list student → Sistem kirim parameter id_edit=123(misal) lewatURL (index.php?id_edit=123).
- Sistem menerima ada id_edit → Panggil StudentController::edit().
- Controller minta data student ID 123 ke Model:
- Student::getStudentById(123);  
- Model ambil data dari database (SELECT * FROM students WHERE id=123).
- Controller kirim data ke View → Form terisi data lama.
- User edit data → Klik tombol Update
- Form kirim data via POST → Sistem deteksi parameter update → Panggil StudentController::edit()
- Controller minta Model update data:
- Student::updateStudent($id, $newData);  
- Model jalankan query UPDATE → Redirect ke index.php

4. Delete Data
- User klik tombol Hapus di list student → Sistem kirim parameter id_hapus=123 via URL (index.php?id_hapus=123).
- Sistem menerima ada id_hapus → Panggil StudentController::delete().
- Controller minta Model hapus data:
- Student::deleteStudent(123);  
- Model jalankan query DELETE FROM students WHERE id=123.
- Redirect ke index.php → Data hilang dari list.

Begitu juga dengan yang bagian tabel Departemens, namun saat akan menghapus baris di departmens controller akan mengecek dulu apakah ada id yang sedang di pakai di tabel Students, karna Departmens menjadi fk di tabel tersebut.

# Dokumentasi
![tp 9](https://github.com/user-attachments/assets/ce346ed7-77b6-4011-b6e7-8f48bf31b5e0)

