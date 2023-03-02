<?php
require("./connect_program.php");
$num_check = 0;
$sql_sum = "SELECT sum(weight) as sum_weight,clo_id,assign_id FROM clo_assignment GROUP BY clo_id,assign_id  ORDER BY `clo_assignment`.`assign_id` ASC";
$query_sum = mysqli_query($connect,$sql_sum);
while($sum = mysqli_fetch_array($query_sum)){
    $clo_id = $sum['clo_id'];
    $assign_id = $sum['assign_id'];
    $query_weight = mysqli_query($connect,"SELECT weight,sub_assign_id FROM clo_assignment WHERE clo_id = '$clo_id' AND assign_id = $assign_id ");
    while($weight = mysqli_fetch_array($query_weight)){
        $sub_ass = $weight['sub_assign_id'];
        $proport = $weight['weight']/$sum['sum_weight'];
        echo $weight['weight'].":".$sum['sum_weight'].":".$sub_ass."= pro ".$proport."<br>";
        $check = mysqli_query($connect, "SELECT * FROM calculate_proport WHERE clo_id='$clo_id' AND sub_assign_id='$sub_ass' AND assign_id = $assign_id");
        while ($check_table = mysqli_fetch_array($check)) {
          $weight_clo = "UPDATE calculate_proport SET proport_weight='$proport' WHERE clo_id='$clo_id' AND sub_assign_id='$sub_ass' AND assign_id = $assign_id";
          $num_check = 1;
          
        }
        if ($num_check == 0) {
          $weight_clo = "INSERT INTO calculate_proport(clo_id,sub_assign_id,proport_weight,assign_id) VALUE('$clo_id','$sub_ass','$proport','$assign_id')";
        }
        $result = mysqli_query($connect, $weight_clo);
    }
    $num_check = 0;
}
?>