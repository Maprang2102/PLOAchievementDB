<?php
require('./connect_program.php');
if (isset($_POST['btnSubmit'])) {
    $course_id = $_POST['course_id'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $table2 = "SELECT `clo`.`clo_name`,`clo`.`clo_code`,`clo`.`clo_id`  FROM `course_clo` 
    LEFT JOIN  `clo`  
    ON   `clo`.clo_id = `course_clo`.clo_id 
    Where `course_clo`.`course_id`  ='$course_id' ";
    $sql_table2 = mysqli_query($connect, $table2);
    while ($clo = mysqli_fetch_array($sql_table2)) {
        $clo = $clo['clo_id'];
        $rdo = "rdo$clo";
        $plo = $_POST[$rdo];
        // echo "clo ".$i.": plo ".$plo;

        $plo_clo = "INSERT INTO plo_clo(year_str,semester_id,course_id,section_id,plo_id,clo_id) VALUE('$year','$semester','$course_id','$section','$plo','$clo')";
        $result = mysqli_query($connect, $plo_clo);
    if ($result) {
        header("location: ./course.php");
    } else {
        echo "Failed";
    }
    }
}
?>