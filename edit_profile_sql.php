<?php
require('./connect_program.php');
if (isset($_POST['btnSubmit'])) {
    $role = $_POST['btnSubmit'];
    echo $role;
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    if ($role == '1') {
        $id = $_POST['txtAdid'];
        $faculty = $_POST['txtFaculty'];
        $query = "INSERT INTO teacher(teacher_id,fname,lname,type) VALUES('$id','$fname','$lname','$faculty')";
    } else if ($role == '2') {
        echo 'success';
        $id = $_POST['txtStuid'];
        $faculty = $_POST['txtFaculty'];
        $program = $_POST['selPro'];
        $query = "INSERT INTO student(student_id,fname,lname,type,program_id) VALUES('$id','$fname','$lname','$faculty','$program')";
    }
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("location: ./edit_profile.php");
    } else {
        echo 'fail';
    }
}
if (isset($_POST['btnEdit'])) {
    $role = $_POST['btnEdit'];
    echo $role;
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    if ($role == '1') {
        $id = $_POST['txtAdid'];
        $faculty = $_POST['txtFaculty'];
        $query = "UPDATE teacher SET fname='$fname',lname='$lname',type='$faculty' WHERE teacher_id='$id'";
    } else if ($role == '2') {
        echo 'success';
        $id = $_POST['txtstuid'];
        $faculty = $_POST['txtFaculty'];
        $program = $_POST['selPro'];
        $query = "UPDATE student SET fname='$fname',lname='$lname',type='$faculty' WHERE student_id='$id'";
    }
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("location: ./edit_profile.php");
    } else {
        echo 'fail';
    }
}
if (isset($_POST['btnDelete'])) {
    $role = $_POST['btnDelete'];
    if ($role == '1') {
        $id = $_POST['txtAdid'];
        $query = "DELETE FROM teacher WHERE teacher_id = '$id'";
    } else if ($role == '2') {
        $id = $_POST['txtstuid'];
        $query = "DELETE FROM student WHERE student_id = '$id'";
    }
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("location: ./edit_profile.php");
    } else {
        echo 'fail';
    }
}