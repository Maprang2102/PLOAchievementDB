<?php
//weight plo_clo * calculate.clo_weigth
//sum_all
//ผลคูณของ weight_plo กับ clo_weight / sum_all
require('./connect_program.php');
$tb_cal_clo_calplo = "SELECT * FROM plo_clo ";
$fill_plo = mysqli_query($connect, $tb_cal_clo_calplo);
$sum_all = 0;
$sum_weight = 0;
$num_check = 0;
while ($plo = mysqli_fetch_array($fill_plo)) {
    $plo_id = $plo['plo_id'];
    $clo_id = $plo['clo_id'];
    
    $tb_cal_clo_calclo = "SELECT DISTINCT student_id FROM calculate_clo WHERE clo_id = '$clo_id'";
    $fill_clo = mysqli_query($connect, $tb_cal_clo_calclo);
    while ($clo = mysqli_fetch_array($fill_clo)) {
        $std_id = $clo['student_id'];
        $fill_std = mysqli_query($connect, "SELECT clo_weight FROM calculate_clo WHERE student_id = '$std_id' AND clo_id = '$clo_id'");
        while ($std = mysqli_fetch_array($fill_std)) {
            $clo_weight = $std['clo_weight'];
            $sum_weight = $clo_weight + $sum_weight;
            $weight_plo = $plo['weight'];
        }
        $temporary = number_format($sum_weight * ($weight_plo / 100), 4);
        echo $temporary."<br>";
        $check = mysqli_query($connect, "SELECT * FROM `calculate_plo` WHERE student_id='$std_id' AND plo_id='$plo_id'");
        while ($check_table = mysqli_fetch_array($check)) {
            $weight_plo = "UPDATE calculate_plo SET plo_weight='$temporary' WHERE student_id='$std_id' AND plo_id='$plo_id'";
            $num_check = 1;
        }
        if ($num_check == 0) {
            $weight_plo = "INSERT INTO calculate_plo(student_id,plo_id,plo_weight) VALUE('$std_id','$plo_id','$temporary')";
        }
        // $product_plo[$std_id][$clo_id] = $temporary;
        // $sum_weight = 0;
        // $sum_all = $sum_all + $product_plo[$std_id][$clo_id];
        // echo "plo : ".$plo_id." clo : ".$clo_id." std : ".$std_id." sum : ".$sum_all."<br>";
        $result = mysqli_query($connect, $weight_plo);
        // if($result){
        //     echo "<hr>";
        // }
        $num_check = 0;
    }
    
        
}
// echo print_r($product_plo);
// echo "<br>" . $sum_all;

// $tb_cal_clo = "SELECT DISTINCT `calculate_clo`.`clo_id`,`plo_clo`.`plo_id`,`calculate_clo`.`student_id` FROM calculate_clo LEFT JOIN plo_clo ON `calculate_clo`.clo_id = `plo_clo`.`clo_id` ";
// $count_clo = mysqli_query($connect, $tb_cal_clo);
// while ($count = mysqli_fetch_array($count_clo)) {
//     $count_clo_id = $count['clo_id'];
//     $count_plo_id = $count['plo_id'];
//     $count_std_id = $count['student_id'];
//     $quotient[$count_plo_id] = $product_plo[$count_std_id][$count_clo_id] / $sum_all;
//     echo $quotient[$count_plo_id] . "<hr>";
// }
// echo print_r($quotient);


?>