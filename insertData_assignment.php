<?php
require('./connect_program.php');
if (isset($_POST['btnAdd'])) {
    $assign_name = $_POST['assign_name'];
    $course_id = $_POST['course_id'];
    $teacher_id = $_POST['teacher_id'];


    $sql = "INSERT INTO assignment(assign_name,course_id,teacher_id) VALUES('$assign_name','$course_id','$teacher_id')";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        header("location: ./assignment.php");
    } else {
        echo "Failed";
    }
}
?>