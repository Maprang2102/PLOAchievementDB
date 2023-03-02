<?php
require("./connect_program.php");
$num_check = 0;
$sql_sum = "SELECT sum(weight) as sum_weight,course_id,plo_id FROM course_plo GROUP BY plo_id";
$query_sum = mysqli_query($connect,$sql_sum);
while($sum = mysqli_fetch_array($query_sum)){
    $plo_id = $sum['plo_id'];
    $query_weight = mysqli_query($connect,"SELECT weight,course_id FROM course_plo WHERE  plo_id = '$plo_id' ORDER BY `course_plo`.`course_id` ASC");
    while($weight = mysqli_fetch_array($query_weight)){
        // $clo_id = $weight['clo_id'];
        $course_id = $weight['course_id'];
        $plo_weight = $weight['weight']/$sum['sum_weight'];
        echo $weight['weight'].":".$sum['sum_weight'].":".$plo_id.":".$course_id."= pro ".$plo_weight."<br>";
        $check = mysqli_query($connect, "SELECT * FROM calculate_plo WHERE course_id='$course_id' AND plo_id = '$plo_id' ");
        while ($check_table = mysqli_fetch_array($check)) {
          $weight_clo = "UPDATE calculate_plo SET plo_weight ='$plo_weight' WHERE course_id='$course_id' AND plo_id = '$plo_id' ";
          $num_check = 1;
        }
        if ($num_check == 0) {
          $weight_clo = "INSERT INTO calculate_plo(course_id,plo_weight,plo_id) VALUE('$course_id','$plo_weight','$plo_id')";
        }
        $result = mysqli_query($connect, $weight_clo);
        $num_check = 0;
    }
    
}
?>