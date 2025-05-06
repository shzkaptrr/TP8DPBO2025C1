<!-- Department.controller.php -->

<?php
include_once("conf.php");
include_once("models/Department.class.php");
include_once("views/Department.view.php");

class DepartmentController{
    private $department;

    function __construct()
    {
      $this->department = new Department(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index()
    {
      // Menyambungkan/membuka jalur ke database
      $this->department->open();
      // Meneruskan request umum dari views (mengambil data grup) 
      $this->department->getDepartment();
      // Inisiasi variabel untuk menyimpan data grup
      $data = array();
      // Push data yang berbentuk object 1 per 1 ke variabel yang sudah dibuat tadi agar dikemas dalam bentuk array
      while ($row = $this->department->getResult()) {
        array_push($data, $row);
      }
      // Menutup jalur ke database
      $this->department->close();
      // Meneruskannya ke view
      $view = new DepartmentView();
      $view->render($data);
    }
     
    // Fungsi untuk menambahkan data
    function add()
    {
        if (isset($_POST['submit'])) {
            // Ambil data dari form
            $name = $_POST['name'];
            $code = $_POST['code'];

            // Buka koneksi ke database
            $this->department->open();

            // Panggil metode addDepartment dengan parameter tambahan 'description'
            $this->department->addDepartment($name, $code);

            // Tutup koneksi ke database
            $this->department->close();

            // Arahkan kembali ke halaman index.php setelah data berhasil ditambahkan
            header("Location: department.php");
            exit;
        }
    }

    // Fungsi untuk mengedit data
    public function edit()
    {
        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $code = $_POST['code'];

            // Buka koneksi ke database
            $this->department->open();

            // Panggil metode updateDepartment dengan parameter tambahan 'description'
            $this->department->updateDepartment($id, $name, $code);

            // Tutup koneksi ke database
            $this->department->close();

            // Arahkan kembali ke halaman index.php setelah data berhasil ditambahkan
            header("Location: department.php");
            exit;
        } else if (!empty($_GET['id_edit'])) {
            // Ambil id dari URL
            $id = $_GET['id_edit'];

            // Buka koneksi ke database
            $this->department->open();

            // Panggil metode getDepartmentById untuk mendapatkan data berdasarkan id
            $this->department->getDepartmentById($id);

            // Ambil hasilnya
            $data = array();
            while ($row = $this->department->getResult()) {
                array_push($data, $row);
            }

            // Tutup koneksi ke database
            $this->department->close();

            // Meneruskannya ke view
            $view = new DepartmentView();
            $view->render(array(), $data[0]);
        }
    }

    public function delete()
    {
        if (!empty($_GET['id_hapus'])) {
            $id = $_GET['id_hapus'];
    
            // Buka koneksi ke database
            $this->department->open();
    
            // Cek apakah masih ada mahasiswa yang tergabung di departemen ini
            $studentCount = $this->department->getStudentCountByDepartment($id);
    
            if ($studentCount > 0) {
                // Jika masih ada mahasiswa, tampilkan alert dan batal hapus
                echo "<script>
                        alert('Tidak bisa menghapus departemen karena masih ada mahasiswa yang terdaftar.');
                        window.location.href = 'department.php';
                      </script>";
            } else {
                // Jika tidak ada mahasiswa, baru hapus departemen
                $this->department->deleteDepartment($id);
                $this->department->close();
    
                // Redirect ke halaman departemen
                header("Location: department.php");
                exit;
            }
    
            $this->department->close(); // Tutup koneksi meskipun tidak jadi hapus
        }
    }
    
}