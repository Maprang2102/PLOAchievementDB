<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php function chart_bar(){ 
  $avg = [];
    $max = [];
    $min = [];
    $j=0;
    $course = $_GET['course'];
    $section = $_GET['section'];
    $semester = $_GET['semester'];
    $year = $_GET['year'];
    require('./connect_program.php');
    $query = "SELECT DISTINCT `clo`.`clo_code`,`calculate_clo`.`clo_id` FROM `calculate_clo` LEFT JOIN clo ON `clo`.`clo_id` = `calculate_clo`.`clo_id` LEFT JOIN `course_clo` ON `clo`.`clo_id` = `course_clo`.`clo_id` WHERE `course_id` = '$course' AND `section_id` = '$section' AND `semester_id` = '$semester' AND `year_str` = '$year'";
    $sql = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_array($sql)) {
      $assignment_number[] = "CLO".$row['clo_code'];
      $clo_code = $row['clo_code'];
      $clo_id = $row['clo_id'];
      // echo "<hr>";
      // $assign = "SELECT DISTINCT `calculate_clo`.`student_id` FROM `calculate_clo` WHERE clo_id = '$clo_id'";
      // $ass = mysqli_query($connect, $assign);
      // while ($ass1 = mysqli_fetch_array($ass)) {
      //   $student_id = $ass1['student_id'];
      // echo "<hr>";
      $clo_weight = "SELECT DISTINCT SUM(clo_weight) AS sum_weight ,AVG(clo_weight+clo_weight) AS avg , MAX(clo_weight+clo_weight) AS max , MIN(clo_weight+clo_weight) AS min  FROM `calculate_clo` WHERE clo_id = '$clo_id' ";
      $clo = mysqli_query($connect, $clo_weight);
      while ($clo1 = mysqli_fetch_array($clo)) {
        $sum_weight[$j] = number_format(($clo1['sum_weight']),4);
        $avg[$j] = number_format(($clo1['avg']),4);
        $max[$j] = number_format(($clo1['max']),4);
        $min[$j] = number_format(($clo1['min']),4);
        // echo "sum : " . number_format($sum_weight[$j], 4) . "<br>";
        // echo "avg : " . $avg[$j] . " max : " . $max[$j] . " min : " . $min[$j]. "<hr>";
        $j++;
        // }
      }
    }
  //   print_r($sum_weight);
    // print_r($clo_weight);
    $value_full = 0;
    $value_max = 0;
    $value_min = 0;
    $value_avg = 0;
    $i = 1;
  ?>
<div style="width: 1000px;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($assignment_number) ?>;
  const data = {
    labels: labels,
    datasets: [{
        type: 'bar',
    label: 'sum',
      data: <?php echo json_encode($sum_weight) ?>,
      backgroundColor: [
    //     'rgba(255, 99, 132, 0.2)',
    //     'rgba(255, 159, 64, 0.2)',
    //     'rgba(255, 205, 86, 0.2)',
    //     'rgba(75, 192, 192, 0.2)',
    //     'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.1)',
    //     'rgba(201, 203, 207, 0.2)'
      ],
    //   borderColor: [
        // 'rgb(255, 99, 132)',
        // 'rgb(255, 159, 64)',
        // 'rgb(255, 205, 86)',
        // 'rgb(75, 192, 192)',
        // 'rgb(54, 162, 235)',
        // 'rgb(153, 102, 255)',
        // 'rgb(201, 203, 207)'
    //   ],
      borderWidth: 1},{
        type: 'line',
      label: 'Maximum',
      data: <?php echo json_encode($max) ?>,
    //   backgroundColor: [
        // 'rgba(255, 99, 132, 0.2)',
        // 'rgba(255, 159, 64, 0.2)',
        // 'rgba(255, 205, 86, 0.2)',
        // 'rgba(75, 192, 192, 0.2)',
        // 'rgba(54, 162, 235, 0.2)',
        // 'rgba(153, 102, 255, 0.2)',
        // 'rgba(201, 203, 207, 0.2)'
    //   ],
      borderColor: [
        // 'rgb(255, 99, 132)',
        // 'rgb(255, 159, 64)',
        // 'rgb(255, 205, 86)',
        // 'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        // 'rgb(153, 102, 255)',
        // 'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    },{
        type: 'line',
    label: 'Minimum',
      data: <?php echo json_encode($min) ?>,
    //   backgroundColor: [
    //     'rgba(255, 99, 132, 0.2)',
    //     'rgba(255, 159, 64, 0.2)',
    //     'rgba(255, 205, 86, 0.2)',
    //     'rgba(75, 192, 192, 0.2)',
    //     'rgba(54, 162, 235, 0.2)',
    //     'rgba(153, 102, 255, 0.2)',
    //     'rgba(201, 203, 207, 0.2)'
    //   ],
      borderColor: [
        // 'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        // 'rgb(255, 205, 86)',
        // 'rgb(75, 192, 192)',
        // 'rgb(54, 162, 235)',
        // 'rgb(153, 102, 255)',
        // 'rgb(201, 203, 207)'
      ],
      borderWidth: 1},
      {
        type: 'line',
    label: 'Average',
      data: <?php echo json_encode($avg) ?>,
    //   backgroundColor: [
    //     'rgba(255, 99, 132, 0.2)',
    //     'rgba(255, 159, 64, 0.2)',
    //     'rgba(255, 205, 86, 0.2)',
    //     'rgba(75, 192, 192, 0.2)',
    //     'rgba(54, 162, 235, 0.2)',
    //     'rgba(153, 102, 255, 0.2)',
    //     'rgba(201, 203, 207, 0.2)'
    //   ],
      borderColor: [
        // 'rgb(255, 99, 132)',
        // 'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        // 'rgb(75, 192, 192)',
        // 'rgb(54, 162, 235)',
        // 'rgb(153, 102, 255)',
        // 'rgb(201, 203, 207)'
      ],
      borderWidth: 1},
      ]
  };

  const config = {
    
    data: data,
    // options: {
    //   scales: {
    //     y: {
    //       beginAtZero: true
    //     }
    //   }
    // },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>
  <?php } ?>
  <!-- <script>
    const myChart = new Chart(
      document.getElementById('myChart1'),
      config
    );
  </script> -->
</body>
</html>