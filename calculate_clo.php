<?php
//std_id sub_assign_id->assign_id clo_id
require('./connect_program.php');
$sum = 0;
$i = 0;
$j = 0;
$clo_id_old = 0;
//fillter assign_id
$tb_cal_ass = "SELECT distinct `sub_assignment`.`assign_id` FROM `calculate` 
    LEFT JOIN  `sub_assignment`  
    ON `sub_assignment`.sub_assign_id = `calculate`.sub_assign_id ";
$fill_assign = mysqli_query($connect, $tb_cal_ass);
while ($ass = mysqli_fetch_array($fill_assign)) {
    // echo "ass <br>";
    $assign_id = $ass['assign_id'];
    //fillter std_id
    $tb_cal_std = "SELECT distinct student_id FROM calculate ";
    $fill_std_id = mysqli_query($connect, $tb_cal_std);
    while ($std = mysqli_fetch_array($fill_std_id)) {
        // echo "std <hr>";
        $std_id = $std['student_id'];
        $ary_std_id[] = $std_id;
        //fillter clo_id
        $tb_cal_clo = "SELECT distinct `calculate`.`clo_id` FROM `calculate` LEFT JOIN  `sub_assignment`  
            ON   `sub_assignment`.sub_assign_id = `calculate`.sub_assign_id WHERE student_id = '$std_id' AND assign_id = '$assign_id' ORDER BY `calculate`.`clo_id` ASC ";
        $fill_clo = mysqli_query($connect, $tb_cal_clo);
        $i = 0;
        while ($clo = mysqli_fetch_array($fill_clo)) {
            $clo_id = $clo['clo_id'];
            $tb_cal_weight = "SELECT distinct `calculate`.`clo_weight` FROM `calculate` LEFT JOIN  `sub_assignment`  
            ON   `sub_assignment`.sub_assign_id = `calculate`.sub_assign_id WHERE student_id = '$std_id' AND assign_id = '$assign_id' AND clo_id = '$clo_id'";
            $fill_weight = mysqli_query($connect, $tb_cal_weight);
            while ($weight = mysqli_fetch_array($fill_weight)) {
                $clo_weight = $weight['clo_weight'];
                echo "ass" . $assign_id . "std : " . $std_id  . " clo : " . $clo_id . "<br>";
                echo $weight['clo_weight'] . "<br>";
                $sum = $sum + $clo_weight;
            }
            $sumall[$std_id][$assign_id][$clo_id] = $sum;
            $sum = 0;
            echo "<hr><hr>";
            $i++;
        }
        // $clo_id_old = 0;
        $sum = 0;
    }
    echo "<hr>";
    $j++;
}
print_r($sumall);
echo $j . $i;


//sum clo
$sum_all = 0;
$num_check = 0;
$ary_sum = [];
$tb_std_id = "SELECT distinct `calculate`.`student_id` FROM `calculate` ";
$fill_id = mysqli_query($connect, $tb_std_id);
while ($id = mysqli_fetch_array($fill_id)) {
    $fill_assign1 = mysqli_query($connect, $tb_cal_ass);
    while ($ass1 = mysqli_fetch_array($fill_assign1)) {
        $assign = $ass1['assign_id'];
        $fill_clo_id = mysqli_query($connect, $tb_cal_clo);
        while ($clo_id = mysqli_fetch_array($fill_clo_id)) {
            $clo_id01 = $clo_id['clo_id'];
            $std_id = $id['student_id'];
            $sum_all = $sumall[$std_id][$assign][$clo_id01] + $sum_all;
            echo "<br>ary : " . $std_id . " : " . $assign . " : " . $clo_id01;
            echo "<br>sum_all : " . $sum_all;
        }
        $assign_id1 = $ass1['assign_id'];
        $ary_sum[$id['student_id']][$assign] = $sum_all;
        $sum_all = 0;
        $fill_clo_id = mysqli_query($connect, $tb_cal_clo);
        $b = 0;
        while ($clo_id1 = mysqli_fetch_array($fill_clo_id)) {
            $clo_id = $clo_id1['clo_id'];
            echo $clo_id;
            $final_sum = $sumall[$std_id][$assign][$clo_id] / $ary_sum[$id['student_id']][$assign];
            echo "<br>final_sum : "  . number_format($final_sum, 4);
            $b++;
            $check = mysqli_query($connect, "SELECT * FROM `calculate_clo` WHERE student_id='$std_id' AND assign_id='$assign' AND clo_id='$clo_id' ");
            while ($check_table = mysqli_fetch_array($check)) {
                $weight_clo = "UPDATE calculate_clo SET clo_weight='$final_sum' WHERE student_id='$std_id' AND clo_id='$clo_id' AND assign_id='$assign_id1'";
                $num_check = 1;
            }
            if ($num_check == 0) {
                $weight_clo = "INSERT INTO calculate_clo(student_id,clo_id,assign_id,clo_weight) VALUE('$std_id','$clo_id','$assign_id1','$final_sum')";
            }
            $result = mysqli_query($connect, $weight_clo);
           $num_check = 0;
        } 
        
    }
}
print_r($final_sum);
//keep in ary 
//sum_all array
//sum/sumall array
//keep result to ary n show chart ///
