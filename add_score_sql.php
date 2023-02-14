<?php 
require('./connect_program.php');
if(isset($_POST['btnSave'])){
    $check_update = 0;
    $count_txt = $_POST['count_txt'];
    for ($i = 0; $i <= $count_txt; $i++) {
        $txt = "txt_sco$i";
        $score = "txt_sco_old$i";
        $sub = "txt_sub$i";
        $clo_assign = "txt_clo_assign$i";
        $student_id = "txt_id$i";
        echo $i;
        if (($_POST[$txt]) != "") {
            $txtScore = $_POST[$txt];
            // $score_old = $_POST[$score];
            $sub_id = $_POST[$sub];
            $clo_assign = $_POST[$clo_assign];
            $student_id = $_POST[$student_id];
            
            $check_update = 0;
            $check1 = mysqli_query($connect, "SELECT * FROM student_sub_assign_score WHERE sub_assign_id='$sub_id' AND clo_assign_id ='$clo_assign' AND student_id='$student_id'");
        while ($check2 = mysqli_fetch_array($check1)) {
            $student_sub_assign_score = "UPDATE student_sub_assign_score SET score='$txtScore' WHERE sub_assign_id='$sub_id' AND clo_assign_id ='$clo_assign' AND student_id='$student_id'";
            $check_update = 1;
        }echo $check_update;
        if ($check_update == 0) {
            $student_sub_assign_score = "INSERT INTO student_sub_assign_score(score,sub_assign_id,clo_assign_id,student_id) VALUE ('$txtScore','$sub_id','$clo_assign','$student_id')";
        }
        echo "score : ".$txtScore."sub : ".$sub_id."clo_ass : ".$clo_assign."std_id : ".$student_id."<br>";
        
        
        $result = mysqli_query($connect, $student_sub_assign_score);
           
        }
    }
    if ($result) {
        require('./calculate.php');
        header("location: ./add_score.php");
    } else {
        echo "Failed";
    }
}


?>