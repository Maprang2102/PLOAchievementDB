<?php 
require('./connect_program.php');

$id_program = $_POST['id_program_clo'];
$course_id = $_POST['course_id'];
$course_name = $_POST['course_name'];

$course_spl = "INSERT INTO course_in_program(course_id,course_name,id_program) VALUE('$course_id','$course_name','$id_program')";

$result = mysqli_query($connect, $course_spl);

if($result){
    include "./plopage.php";
}else{
    echo "Failed";
}
?>