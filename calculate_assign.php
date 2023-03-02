<?php
require("./connect_program.php");
$num_check = 0;
$sql_sum = "SELECT sum(full_score) as sum_weight,course_id FROM assignment GROUP BY course_id;";
$query_sum = mysqli_query($connect,$sql_sum);
while($sum = mysqli_fetch_array($query_sum)){
    $course_id = $sum['course_id'];
    $query_weight = mysqli_query($connect,"SELECT full_score,assign_id FROM assignment WHERE course_id = $course_id ");
    while($weight = mysqli_fetch_array($query_weight)){
        $assign_id = $weight['assign_id'];
        $assign_weight = $weight['full_score']/$sum['sum_weight'];
        echo $weight['full_score'].":".$sum['sum_weight'].":".$assign_id."= pro ".$assign_weight."<br>";
        $check = mysqli_query($connect, "SELECT * FROM calculate_assign WHERE course_id='$course_id' AND assign_id = '$assign_id'");
        while ($check_table = mysqli_fetch_array($check)) {
          $weight_clo = "UPDATE calculate_assign SET assign_weight ='$assign_weight' WHERE course_id='$course_id' AND assign_id = '$assign_id'";
          $num_check = 1;
        }
        if ($num_check == 0) {
          $weight_clo = "INSERT INTO calculate_assign(course_id,assign_weight,assign_id) VALUE('$course_id','$assign_weight','$assign_id')";
        }
        $result = mysqli_query($connect, $weight_clo);
        $num_check = 0;
    }
    
}
?>