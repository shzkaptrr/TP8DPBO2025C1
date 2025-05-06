<!-- department.php -->

<?php

include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Department.controller.php");

$department = new DepartmentController();

if (isset($_POST['submit'])) {
    $department->add();
} else if (isset($_POST['update'])) {
    $department->edit();
} else if (!empty($_GET['id_hapus'])) {
    $department->delete();
} else if (!empty($_GET['id_edit'])) {
    $department->edit();
} else {
    $department->index();
}