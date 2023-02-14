<?php
require("./connect_program.php");
$sum_weigth = "SELECT assign_id, sub_assign_id, SUM(weight) AS sum_weight FROM `clo_assignment` GROUP BY sub_assign_id";
//assign_id ยังไม่ได้แยกออก

$ary_weight = [];
$i = 0;
$j = 0;
$clo_weight = 0;
$sql_sum_weigth = mysqli_query($connect, $sum_weigth);
while ($row = mysqli_fetch_array($sql_sum_weigth)) {
  $sub_assign = $row['sub_assign_id'];
  $assign_id = $row['assign_id'];
  $sum_weight = $row['sum_weight'];
  $ary_weight[$i][$j] = $sub_assign;
  $j = 0;
  $clo = mysqli_query($connect, "SELECT `course_clo`.`clo_id` FROM `course_clo` LEFT JOIN `assignment` ON `assignment`.course_id = `course_clo`.course_id Where `assignment`.`assign_id` ='$assign_id' ORDER BY `course_clo`.`clo_id` ASC");
  while ($clo1 = mysqli_fetch_array($clo)) {
    $clo_id = $clo1['clo_id'];
    echo "sub:" . $sub_assign . " clo:" . $clo_id . "<br>";
    $weigth = "SELECT * FROM clo_assignment WHERE sub_assign_id = '$sub_assign' AND clo_id = '$clo_id' ";
    $sql_weigth = mysqli_query($connect, $weigth);

    while ($row1 = mysqli_fetch_array($sql_weigth)) {
      $clo_weight = $row1['weight'] / $sum_weight;
    }
    $ary_weight[$i][$j] = $clo_weight;
    echo $i . $j . "=" . $ary_weight[$i][$j] . "<br>";
    $j++;
    $clo_weight = 0;
  }

  $i++;
}
echo "------student--------<br>";
$m = 0;
$n = 0;
$sum = 0;
$num_check = 0;
$ary_score = [];
$ary_std_id = [];
$assign_id_query = "SELECT distinct assign_id FROM clo_assignment ";
$assign = mysqli_query($connect, $assign_id_query);
while ($assign_std = mysqli_fetch_array($assign)) {
  $assign_id_std = $assign_std['assign_id'];
  echo "assign_id : " . $assign_id_std . "<br>";
  $student = "SELECT distinct student_id FROM student_sub_assign_score ";
  $sql_std = mysqli_query($connect, $student);
  while ($row1_std = mysqli_fetch_array($sql_std)) {
    $m = 0;
    $std_id = $row1_std['student_id'];
    $ary_std_id[] = $std_id;
    echo $std_id . "<br>";
    $fill_assign = "SELECT distinct sub_assign_id FROM clo_assignment WHERE assign_id = '$assign_id_std'";
    $sql_sum_weigth_std = mysqli_query($connect, $fill_assign);
    while ($row_std = mysqli_fetch_array($sql_sum_weigth_std)) {
      $sub_assign_std = $row_std['sub_assign_id'];
      // $assign_id_std = $row_std['assign_id'];
      $n = 0;
      $clo_std = mysqli_query($connect, "SELECT `course_clo`.`clo_id` FROM `course_clo` LEFT JOIN `assignment` ON `assignment`.course_id = `course_clo`.course_id Where `assignment`.`assign_id` ='$assign_id_std' ORDER BY `course_clo`.`clo_id` ASC");
      while ($clo1_std = mysqli_fetch_array($clo_std)) {
        $clo_id_std = $clo1_std['clo_id'];
        echo "sub:" . $sub_assign_std . " clo:" . $clo_id_std . "<br>";

        $std_score = mysqli_query($connect, "SELECT `student_sub_assign_score`.`score` FROM `student_sub_assign_score` LEFT JOIN `clo_assignment` ON `clo_assignment`.clo_assign_id = `student_sub_assign_score`.clo_assign_id Where `clo_assignment`.`clo_id` ='$clo_id_std' AND `student_sub_assign_score`.`sub_assign_id`='$sub_assign_std' AND `student_sub_assign_score`.`student_id`='$std_id' ORDER BY `student_sub_assign_score`.`score` ASC");
        while ($std = mysqli_fetch_array($std_score)) {
          $score = $std['score'];
        }
        $ary_score[$std_id][$m][$n] = $ary_weight[$m][$n] * $score;
        $clo_weight_std = $ary_weight[$m][$n] * $score;
        echo  $std_id . $m . $n . "=" . $ary_score[$std_id][$m][$n] . "<br>";
        $n++;
        $check = mysqli_query($connect, "SELECT * FROM `calculate` ");
        while ($check_table = mysqli_fetch_array($check)) {
          $weight_clo = "UPDATE calculate SET clo_weight='$clo_weight_std' WHERE student_id='$std_id' AND clo_id='$clo_id_std' AND sub_assign_id='$sub_assign_std'";
          $num_check = 1;
          
        }
        if ($num_check == 0) {
          $weight_clo = "INSERT INTO calculate(student_id,clo_id,sub_assign_id,clo_weight) VALUE('$std_id','$clo_id_std','$sub_assign_std','$clo_weight_std')";
        }
        $result = mysqli_query($connect, $weight_clo);
      }
      
      $num_check = 0;
      $m++;
    }
  }
  // print_r($ary_score);
  // for ($id = 0; $id < 2; $id++) { // ดึงค่ารหัสนิสิต
  //   for ($a = 0; $a < $n; $a++) { //ดึงค่าassign
  //     for ($b = 0; $b < $m; $b++) { //ดึงค่าclo
  //       $sum = $ary_score[$ary_std_id[$id]][$b][$a] + $sum;
  //       echo $ary_std_id[$id] . " : " . $b . $a . "--" . $sum . "--<br>";
  //     }
  //     $sum_all[$ary_std_id[$id]][$a] = $sum;
  //     $sum = 0;
  //   }
  // }
  // print_r($sum_all);
}
//หาผลรวมของ sum_all 
//เอา sum_all มาหารกับผลรวม = clo
//เอา clo มาคูณกับ weight_plo แล้วหาผลรวม
//เอาผลรวมมาหารผลคูณของ weight_plo = plo