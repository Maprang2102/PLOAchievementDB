<?php
require('./connect_program.php');
if (isset($_POST['btnAdd'])) {
    $assign_name = $_POST['assign_name'];
    $full_score = $_POST['full_score'];
    $course_id = $_POST['course_id'];
    $teacher_id = $_POST['teacher_id'];
    $clo_year = $_POST['clo_year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $program_id = $_POST['program_id'];

    $sql = "INSERT INTO assignment(assign_name,course_id,teacher_id,full_score) VALUES('$assign_name','$course_id','$teacher_id','$full_score')";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        header("location: ./assignment.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year);
    } else {
        echo "Failed";
    }
}
if (isset($_POST['btnEdit'])) {
    $assign_id = $_POST['assign_id'];
    $full_score = $_POST['full_score'];
    $course_id = $_POST['course_id'];
    $teacher_id = $_POST['teacher_id'];
    $clo_year = $_POST['clo_year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $program_id = $_POST['program_id'];

    $sql = "UPDATE assignment SET full_score='$full_score' WHERE assign_id='$assign_id'";

    $result = mysqli_query($connect, $sql);
    // echo "program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year;

    if ($result) {
        header("location: ./assignment.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year);
    } else {
        echo "Failed";
    }
}
?>