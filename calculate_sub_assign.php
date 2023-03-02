<?php
require("./connect_program.php");
$num_check = 0;
$sql_sum = "SELECT sum(weight) as sum_weight,sub_assign_id,assign_id FROM sub_assignment GROUP BY assign_id;";
$query_sum = mysqli_query($connect,$sql_sum);
while($sum = mysqli_fetch_array($query_sum)){
    $assign_id = $sum['assign_id'];
    $query_weight = mysqli_query($connect,"SELECT weight,sub_assign_id FROM sub_assignment WHERE assign_id = $assign_id ");
    while($weight = mysqli_fetch_array($query_weight)){
        $sub_assign_id = $weight['sub_assign_id'];
        $sub_weight = $weight['weight']/$sum['sum_weight'];
        echo $weight['weight'].":".$sum['sum_weight'].":".$sub_assign_id."= pro ".$sub_weight."<br>";
        $check = mysqli_query($connect, "SELECT * FROM calculate_sub_assign WHERE sub_assign_id='$sub_assign_id' AND assign_id = '$assign_id'");
        while ($check_table = mysqli_fetch_array($check)) {
          $weight_clo = "UPDATE calculate_sub_assign SET sub_assign_weight ='$sub_weight' WHERE sub_assign_id='$sub_assign_id' AND assign_id = '$assign_id'";
          $num_check = 1;
        }
        if ($num_check == 0) {
          $weight_clo = "INSERT INTO calculate_sub_assign(sub_assign_id,sub_assign_weight,assign_id) VALUE('$sub_assign_id','$sub_weight','$assign_id')";
        }
        $result = mysqli_query($connect, $weight_clo);
        $num_check = 0;
    }
    
}
?>