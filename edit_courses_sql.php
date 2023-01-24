<?php
require("./connect_program.php");
if (isset($_POST["btnSubmit"])) {
    $pro = $_POST["selectPro"];
    $id = $_POST["txtId"];
    $name = $_POST["txtNameth"];
    $course_engname = $_POST["txtNameen"];
    $year = $_POST["txtYear"];
    $sec = $_POST["txtSec"];
    $selectSemes = $_POST["selectSemes"];

    $insert_sec = mysqli_query($connect, "INSERT INTO section(section_name) VALUES ('$sec')");

    $query = "INSERT INTO course(course_code,course_name, course_engname) VALUES('$id','$name','$course_engname')";
    $result = mysqli_query($connect, $query);

    $max = "SELECT MAX(section_id) as 'section_id' FROM section";
    $query = mysqli_fetch_array(mysqli_query($connect, $max));
    $section_id = $query['section_id'];

    $sem = "SELECT * FROM semester WHERE semester_name = '$selectSemes'";
    $query = mysqli_fetch_array(mysqli_query($connect, $sem));
    $semester_id = $query['semester_id'];

    $cou = "SELECT * FROM course WHERE course_code = '$id'";
    $query = mysqli_fetch_array(mysqli_query($connect, $cou));
    $course_id = $query['course_id'];

    $program_course = "INSERT INTO program_course(year_str,semester_id,course_id,section_id,program_id,teacher_id) VALUE('$year','$semester_id','$course_id','$section_id','$pro','62363660')";
    $program_course1 = mysqli_query($connect, $program_course);
    if ($program_course1) {
        header("location: ./edit_courses.php");
    } else {
        echo 'fail';
    }
}


if (isset($_POST["btnDelete"])) {
    $id = $_POST["btnDelete"];
    $query = "DELETE FROM course WHERE course_id = '$id'";
    if (mysqli_query($connect, $query)) {
        header("location: ./edit_courses.php");
    }
}

if (isset($_POST["btnEdit"])) {
    $id = $_POST["editId"];
    $name = $_POST["editName"];
    $course_engname = $_POST["editNameeng"];


    $query = "UPDATE course SET course_name='$name',course_engname='$course_engname' WHERE course_id='$id'";
    // $result = mysqli_query($connect, $query);
    if (mysqli_query($connect, $query)) {
        header("location: ./edit_courses.php");
    } else {
        echo 'fail';
    }
};
