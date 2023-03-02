<?php 
require('./connect_program.php');
$course_id = '305282';
$sum_assign = 0;
$clo_old = 0;
$assign_score = 0;
$sql_std = "SELECT * FROM student_score WHERE course_id = '$course_id'";
$query_std = mysqli_query($connect,$sql_std);
while($std = mysqli_fetch_array($query_std)){
    $student_id = $std['student_id'];
    $sql_score = "SELECT * FROM student_sub_assign_score std INNER JOIN clo_assignment clo ON std.clo_assign_id = clo.clo_assign_id WHERE student_id = '$student_id' ORDER BY clo.clo_id,clo.sub_assign_id ASC";
    $query_score = mysqli_query($connect,$sql_score);
    while($score = mysqli_fetch_array($query_score)){
        $score_std = $score['score'];
        $clo_id = $score['clo_id'];
        if($clo_id != $clo_old){
            $sum_assign = 0;
                
            }
        $sub_assign_id = $score['sub_assign_id'];
        $sql_proport = "SELECT * FROM calculate_proport WHERE clo_id = '$clo_id' AND sub_assign_id = '$sub_assign_id'  ";
        $query_proport = mysqli_query($connect,$sql_proport);
        while($proport = mysqli_fetch_array($query_proport)){
           
            $assign_id = $proport['assign_id'];
            $proport_score = $proport['proport_weight']*$score_std;
            $sql_sub = "SELECT * FROM calculate_sub_assign WHERE assign_id = '$assign_id' AND sub_assign_id = '$sub_assign_id'";
            $query_sub = mysqli_query($connect,$sql_sub);
            while($sub = mysqli_fetch_array($query_sub)){
                $sub_score = $sub['sub_assign_weight']*$proport_score;
                
                $sql_assign = "SELECT * FROM calculate_assign WHERE assign_id = '$assign_id' AND course_id = '$course_id'";
                $query_assign = mysqli_query($connect, $sql_assign);
                while($assign = mysqli_fetch_array($query_assign)){
                    $assign_score = $assign['assign_weight']*$sub_score;
                    $sum_assign = $assign_score + $sum_assign;
                    echo "std :: ".$student_id." ::assign : ".$course_id." : ".$clo_id." score_sum : ".$sum_assign."<br>";
            }
            
            
            }
            // echo "<hr>".$clo_id." :: ".$clo_old."<br>";
            if($clo_id == $clo_old && $clo_old != 0){
                $sum[$student_id][$course_id][$clo_id] = $sum_assign;
            }
            $clo_old = $clo_id;
        }
        
        // echo $clo_id;
        
    }
}print_r($sum);

//PLO_COURSE


?>