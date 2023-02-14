<?php
require('./connect_program.php');
if (isset($_POST['btnSubmit'])) {
    $check_update = 0;
    $count = 0;
    $course_id = $_POST['course_id'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    // $weight = $_POST['txtweight'];
    $table2 = "SELECT `clo`.`clo_name`,`clo`.`clo_code`,`clo`.`clo_id`  FROM `course_clo` 
    LEFT JOIN  `clo`  
    ON   `clo`.clo_id = `course_clo`.clo_id 
    Where `course_clo`.`course_id`  ='$course_id' ";
    $sql_table2 = mysqli_query($connect, $table2);
    while ($clo = mysqli_fetch_array($sql_table2)) {
        $clo = $clo['clo_id'];
        $rdo = "rdo$clo";
        $plo = $_POST[$rdo];
        $weight_count = "txtweight$count";
        $weight = $_POST[$weight_count];
        $count++;
        // echo "clo : ".$clo." plo : ".$plo." weight : ".$weight;
        
        $check1 = mysqli_query($connect, "SELECT * FROM plo_clo WHERE course_id = '$course_id' AND year_str = '$year' AND semester_id = '$semester' AND section_id = '$section' AND plo_id = '$plo' AND clo_id = '$clo'");
        while ($check2 = mysqli_fetch_array($check1)) {
            $plo_clo = "UPDATE plo_clo SET weight='$weight' WHERE course_id = '$course_id' AND year_str = '$year' AND semester_id = '$semester' AND section_id = '$section' AND plo_id = '$plo' AND clo_id = '$clo'";
            $check_update = 1;
        }
        if ($check_update == 0) {
            echo "<hr>";
            $plo_clo = "INSERT INTO plo_clo(year_str,semester_id,course_id,section_id,plo_id,clo_id,weight) VALUE('$year','$semester','$course_id','$section','$plo','$clo','$weight')";
        }
        $check_update = 0;
        $result = mysqli_query($connect, $plo_clo);
        
    }
    if ($result) {
            header("location: ./course.php");
        } else {
            echo "Failed";
        }
}
