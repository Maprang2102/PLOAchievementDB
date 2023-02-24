<?php
require('./connect_program.php');
if(isset($_POST['btnAdd'])){
    $program_id = $_POST['program_id'];
    $course_id = $_POST['course'];
    $semester_id = $_POST['semester'];
    $section_id = $_POST['section'];
    $year = $_POST['year'];
    $student_id = $_POST['student_id'];
    $student_course = "INSERT INTO student_score(year_str,semester_id,course_id,section_id,student_id) VALUE('$year','$semester_id','$course_id','$section_id','$student_id')";
    $student_course1 = mysqli_query($connect, $student_course);
    if ($student_course1) {
        header("location: ./add_student_course.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$year);
    } else {
        echo 'fail';
    }
}
echo "del";
if(isset($_POST['btnDelete'])){
    echo "delete";
    $student_score_id = $_POST['btnDelete'];
    $query = "DELETE FROM student_score WHERE student_score_id = '$student_score_id'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("location: ./add_student_course.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$year);
    } else {
        echo 'fail';
    }
}
?>