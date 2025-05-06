<?php

class Student extends DB
{
    function getStudent() {
        $query = "SELECT students.*, departments.name as department_name 
                FROM students 
                LEFT JOIN departments ON students.id_department = departments.id";
        return $this->execute($query);
    }

    // Tambahkan parameter id_department
    function addStudent($name, $nim, $phone, $join_date, $id_department) {
        $query = "INSERT INTO students (name, nim, phone, join_date, id_department) 
                VALUES ('$name', '$nim', '$phone', '$join_date', '$id_department')";
        return $this->execute($query);
    }

    // Update query untuk ambil department
    public function getStudentById($id) {
        $query = "SELECT students.*, departments.name as department_name 
                FROM students 
                LEFT JOIN departments ON students.id_department = departments.id 
                WHERE students.id=$id";
        $this->execute($query);
    }

    // Tambahkan parameter id_department
    function updateStudent($id, $name, $nim, $phone, $join_date, $id_department) {
        $query = "UPDATE students 
                SET name='$name', nim='$nim', phone='$phone', 
                    join_date='$join_date', id_department='$id_department' 
                WHERE id=$id";
        return $this->execute($query);
    }

    function deleteStudent($id)
    {
        $query = "DELETE FROM students WHERE id=$id";
        return $this->execute($query);
    }
}
