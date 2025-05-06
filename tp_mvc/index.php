<?php

include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Student.controller.php");

$student = new StudentController();

if (isset($_POST['submit'])) {
    $student->add();
} else if (isset($_POST['update'])) {
    $student->edit();
} else if (!empty($_GET['id_hapus'])) {
    $student->delete();
} else if (!empty($_GET['id_edit'])) {
    $student->edit();
} else {
    $student->index();
}