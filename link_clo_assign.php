<?php
require('./connect_program.php');
if (isset($_POST['btnSubmit'])) {
    $count_txt = $_POST['count_txt'];
    for ($i = 0; $i <= $count_txt; $i++) {
        $txt = "txtweight$i";
        $weight = "weight_old$i";
        $clo = "clo_id$i";
        $sub_assign = "sub_assign_id$i";
        $assign = "assign_id$i";
        if (($_POST[$txt]) != "") {
            $txtWeight = $_POST[$txt];
            $weight_old = $_POST[$weight];
            $clo_id = $_POST[$clo];
            $sub_assign_id = $_POST[$sub_assign];
            $assign = $_POST[$assign];
            if ($_POST[$weight] != "") {
                $clo_assignment = "UPDATE clo_assignment SET weight='$txtWeight' WHERE clo_id='$clo_id' AND sub_assign_id ='$sub_assign_id' AND assign_id='$assign'";
            } else {
                $clo_assignment = "INSERT INTO clo_assignment(weight,clo_id,sub_assign_id,assign_id) VALUE ('$txtWeight','$clo_id','$sub_assign_id','$assign')";
            }
            $result = mysqli_query($connect, $clo_assignment);
            if ($result) {
                header("location: ./assignment.php");
            } else {
                echo "Failed";
            }
        }
    }
}
if (isset($_POST['btnDelete'])) {
    //
}
?>
