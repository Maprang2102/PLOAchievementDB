<?php
require('./connect_program.php');
if (isset($_POST["btnAdd"])) {
    $topic = $_POST['topic'];
    $weight = $_POST['weight'];
    $assign_id = $_POST['assign_id'];
    $course_id = $_POST['course_id'];
    $clo_year = $_POST['clo_year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $program_id = $_POST['program_id'];

    $course_spl = "INSERT INTO sub_assignment(topic,weight,assign_id) VALUE('$topic','$weight','$assign_id')";
    // echo "-------".$topic.$weight; 
    $result = mysqli_query($connect, $course_spl);

    if ($result) {
        header("location: ./assignment.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year);
    } else {
        echo "Failed";
    }
}
if (isset($_POST["btnEdit"])) {
    $topic = $_POST['topic_edit'];
    // $weight = $_POST['weight'];
    $sub_assign_id = $_POST['sub_assign_id'];
    $course_id = $_POST['course_id'];
    $clo_year = $_POST['clo_year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $program_id = $_POST['program_id'];

    $course_spl = "UPDATE sub_assignment SET topic='$topic' WHERE sub_assign_id = '$sub_assign_id'";

    $result = mysqli_query($connect, $course_spl);

    if ($result) {
        header("location: ./assignment.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year);
    } else {
        echo "Failed";
    }
}
?>