<?php
require('./connect_program.php');
if (isset($_POST['btnSubmit'])) {
    $count_txt = $_POST['count_txt'];
    for ($i = 1; $i <= $count_txt; $i++) {
        $txt = "txtweight$i";
        $plo = "plo_id$i";
        $course = "course_id$i";
        if (($_POST[$txt]) != "") {
            $txtWeight = $_POST[$txt];
            $plo_id = $_POST[$plo];
            $course_id = $_POST[$course];

            $course_plo = "INSERT INTO course_plo(weight,plo_id,course_id) VALUE ('$txtWeight','$plo_id','$course_id')";
            $result = mysqli_query($connect, $course_plo);
            if ($result) {
                header("location: ./plopage.php");
            } else {
                echo "Failed";
            }
        }
    }
}
if (isset($_POST['btnEdit'])) {
    $count_txt = $_POST['count_txt'];
    for ($i = 1; $i <= $count_txt; $i++) {
        $txt = "txtweight$i";
        $weight_old = "weight_old$i";
        $plo = "plo_id$i";
        $course = "course_id$i";
        if (($_POST[$txt]) != "") {
            $txtWeight = $_POST[$txt];
            $weight_old = $_POST[$weight_old];
            $plo_id = $_POST[$plo];
            $course_id = $_POST[$course];
            if ($weight_old != "") {
                $course_plo = "UPDATE course_plo SET weight='$txtWeight' WHERE plo_id='$plo_id' AND course_id='$course_id'";
            } else {
                $course_plo = "INSERT INTO course_plo(weight,plo_id,course_id) VALUE ('$txtWeight','$plo_id','$course_id')";
            }
        }
        $result = mysqli_query($connect, $course_plo);
    }
    if ($result) {
        header("location: ./plopage.php");
    } else {
        echo "Failed";
    }
}
