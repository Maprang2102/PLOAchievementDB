<?php
require("./connect_program.php");
$num_check = 0;
$sql_sum = "SELECT sum(weight) as sum_weight,course_id,plo_id FROM plo_clo GROUP BY course_id ,plo_id;";
$query_sum = mysqli_query($connect,$sql_sum);
while($sum = mysqli_fetch_array($query_sum)){
    $course_id = $sum['course_id'];
    $plo_id = $sum['plo_id'];
    $query_weight = mysqli_query($connect,"SELECT weight,plo_id,clo_id FROM plo_clo WHERE course_id = '$course_id' AND plo_id = '$plo_id'");
    while($weight = mysqli_fetch_array($query_weight)){
        $clo_id = $weight['clo_id'];
        $plo_clo_weight = $weight['weight']/$sum['sum_weight'];
        echo $weight['weight'].":".$sum['sum_weight'].":".$plo_id.":".$clo_id."= pro ".$plo_clo_weight."<br>";
        $check = mysqli_query($connect, "SELECT * FROM calculate_plo_course WHERE course_id='$course_id' AND clo_id = '$clo_id'");
        while ($check_table = mysqli_fetch_array($check)) {
          $weight_clo = "UPDATE calculate_plo_course SET plo_clo_weight ='$plo_clo_weight',plo_id = '$plo_id' WHERE course_id='$course_id' AND clo_id = '$clo_id'";
          $num_check = 1;
        }
        if ($num_check == 0) {
          $weight_clo = "INSERT INTO calculate_plo_course(course_id,plo_clo_weight,plo_id,clo_id) VALUE('$course_id','$plo_clo_weight','$plo_id','$clo_id')";
        }
        $result = mysqli_query($connect, $weight_clo);
        $num_check = 0;
    }
    
}
?>