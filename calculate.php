<?php
function group_separate($group, $subgroup)
{
     if ($group == 1) {
          plo_calcu($subgroup);
     } else {
          clo_calcu($subgroup);
     }
}

function plo_calcu($subgroup)
{
}

function clo_calcu($subgroup)
{
     require('./connect_program.php');
     $query = "SELECT * FROM clo_detail WHERE course_id = '$subgroup' ";
     $sql = mysqli_query($connect, $query);
     $clo_one = 0;
     $clo_sum = 0;
     $clo_all = [];
     $i = 0;
     while ($row = mysqli_fetch_array($sql)) {
          $i = $i + 1 ;
               if ($row['clo_detail_number'] == $i){
                    $clo_one = ($row['clo_detail_point'] * $row['clo_weight_value'] ) /100;
                    $clo_sum = $clo_sum + $clo_one;
                    echo "$clo_one";
               
               $clo_all[] = $clo_sum;
               
          }
         
     } 
     print_r($clo_all);
}


$score_clo_assign = [];