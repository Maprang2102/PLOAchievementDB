<?php 
require('./connect_program.php');
if(isset($_POST['btnSave'])){
    $count_txt = $_POST['count_txt'];
    for ($i = 0; $i <= $count_txt; $i++) {
        $txt = "txt_sco$i";
        $score = "txt_sco_old$i";
        $sub = "txt_sub$i";
        $clo_assign = "txt_clo_assign$i";
        $student_id = "txt_id$i";
        if (($_POST[$txt]) != "") {
            $txtScore = $_POST[$txt];
            $score_old = $_POST[$score];
            $sub_id = $_POST[$sub];
            $clo_assign = $_POST[$clo_assign];
            $student_id = $_POST[$student_id];
            if ($_POST[$score] != "") {
                $student_sub_assign_score = "UPDATE student_sub_assign_score SET score='$txtScore' WHERE sub_assign_id='$sub_id' AND clo_assign_id ='$clo_assign' AND student_id='$student_id'";
            } else {
                $student_sub_assign_score = "INSERT INTO student_sub_assign_score(score,sub_assign_id,clo_assign_id,student_id) VALUE ('$txtScore','$sub_id','$clo_assign','$student_id')";
            }
            $result = mysqli_query($connect, $student_sub_assign_score);
            if ($result) {
                header("location: ./add_score.php");
            } else {
                echo "Failed";
            }
        }
    }
}


?>