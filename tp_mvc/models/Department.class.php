<!-- Department.class.php -->

<?php
class Department extends DB {
    function getDepartment() {
        $query = "SELECT * FROM departments";
        return $this->execute($query);
    }

    // Menambahkan department baru
    function addDepartment($name, $code) {
       

        $query = "INSERT INTO departments (name, code) VALUES ('$name', '$code')";
        return $this->execute($query);
    }

    // Mengambil data department berdasarkan ID
    public function getDepartmentById($id) {
        $query = "SELECT id, name, code FROM departments WHERE id=$id";
        $this->execute($query);
    }
    // Mengupdate data department
    function updateDepartment($id, $name, $code) {
        $query = "UPDATE departments SET name='$name', code='$code' WHERE id=$id";
        return $this->execute($query);
    }

    // Menghapus department
    function deleteDepartment($id) {
        $query = "DELETE FROM departments WHERE id=$id";
        return $this->execute($query);
    }

    // Mengecek jumlah mahasiswa dalam suatu departemen
    public function getStudentCountByDepartment($id) {
        $query = "SELECT COUNT(*) AS total FROM students WHERE id_department = $id";
        $result = $this->execute($query); // gunakan $this karena sudah extend DB
        $row = $result->fetch_assoc();
        return $row['total'];
    }


}