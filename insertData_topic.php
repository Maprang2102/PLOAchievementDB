<?php
require('./connect_program.php');
if (isset($_POST["btnAdd"])) {
    $topic = $_POST['topic'];
    $weight = $_POST['weight'];
    $assign_id = $_POST['assign_id'];

    $course_spl = "INSERT INTO sub_assignment(topic,weight,assign_id) VALUE('$topic','$weight','$assign_id')";

    $result = mysqli_query($connect, $course_spl);

    if ($result) {
        header("location: ./assignment.php");
    } else {
        echo "Failed";
    }
}
?>