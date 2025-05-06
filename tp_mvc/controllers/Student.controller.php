<?php
include_once("conf.php");
include_once("models/Student.class.php");
include_once("models/Department.class.php");
include_once("views/Student.view.php");

class StudentController {
    private $student;
    private $department;

    function __construct()
    {
        $this->student = new Student(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->department = new Department(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    }

    public function index() {
        $this->student->open();
        $this->student->getStudent();
        $data = array();
        while ($row = $this->student->getResult()) {
            array_push($data, $row);
        }
        $this->student->close();

        $this->department->open();
        $this->department->getDepartment();
        $departments = array();
        while ($row = $this->department->getResult()) {
            array_push($departments, $row);
        }
        $this->department->close();

        $view = new StudentView();
        $view->render($data, null, $departments);
    }

    function add() {
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            $id_department = $_POST['id_department'];

            $this->student->open();
            $this->student->addStudent($name, $nim, $phone, $join_date, $id_department);
            $this->student->close();

            header("Location: index.php");
            exit;
        }
    }

    public function edit() {
        if (isset($_POST['update'])) {
            // Tangkap semua data dari form
            $id = $_POST['id'];
            $name = $_POST['name'];
            $nim = $_POST['nim'];
            $phone = $_POST['phone'];
            $join_date = $_POST['join_date'];
            $id_department = $_POST['id_department'];

            $this->student->open();
            $this->student->updateStudent($id, $name, $nim, $phone, $join_date, $id_department);
            $this->student->close();

            header("Location: index.php");
            exit;
        } else {
            // Ambil ID dari URL
            $id = $_GET['id_edit'];

            // Ambil data student berdasarkan ID
            $this->student->open();
            $this->student->getStudentById($id); // pastikan ada method ini di model
            $studentData = $this->student->getResult();
            $this->student->close();

            // Ambil semua data departemen
            $this->department->open();
            $this->department->getDepartment();
            $departments = array();
            while ($row = $this->department->getResult()) {
                array_push($departments, $row);
            }
            $this->department->close();

            $data = []; // agar tidak error di foreach()
            $view = new StudentView();
            $view->render($data, $studentData, $departments);
        }
    }

    function delete() {
        $id = $_GET['id_hapus'];

        $this->student->open();
        $this->student->deleteStudent($id);
        $this->student->close();

        header("Location: index.php");
        exit;
    }
}
