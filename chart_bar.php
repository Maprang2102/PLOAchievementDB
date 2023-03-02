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
  require('./connect_program.php');
  $course_id = $_GET["course"];
  $i = 0;
  $sql_score = "SELECT DISTINCT course_id,clo_id , 
    MIN(ary_score) over (PARTITION BY clo_id) as min_clo ,
    MAX(ary_score) over (PARTITION BY clo_id) as max_clo ,
    AVG(ary_score) over (PARTITION BY clo_id) as avg_clo 
  FROM
    (SELECT *,sum(proport_score) AS ary_score
    FROM
      (SELECT stu.sub_assign_id ,stu.student_id,stu.clo_assign_id,clo.clo_id , clo.assign_id , cal_pro.proport_weight , cal_sub.sub_assign_weight , cal_assign.assign_weight , cou_clo.course_id , stu.score*cal_pro.proport_weight*cal_sub.sub_assign_weight*cal_assign.assign_weight as proport_score
        FROM student_sub_assign_score stu ,clo_assignment clo ,calculate_proport cal_pro,calculate_sub_assign cal_sub,calculate_assign cal_assign,course_clo cou_clo
        WHERE stu.sub_assign_id = cal_pro.sub_assign_id AND 
	  clo.clo_assign_id = stu.clo_assign_id AND 
    clo.clo_id = cal_pro.clo_id AND
    cal_sub.assign_id = cal_pro.assign_id AND
    cal_sub.sub_assign_id = cal_pro.sub_assign_id AND
    cal_assign.assign_id = cal_sub.assign_id AND
    cou_clo.clo_id = clo.clo_id AND
	  cou_clo.course_id = '$course_id') 
    AS clo_tb GROUP BY student_id,clo_id) 
  AS sum_clo";

  $query_score = mysqli_query($connect, $sql_score);
  while ($score = mysqli_fetch_array($query_score)) {
    $min[$i] = $score['min_clo'] * 100;
    $max[$i] = $score['max_clo'] * 100;
    $avg[$i] = $score['avg_clo'] * 100;
    $clo[$i] = 'clo' . $i + 1;
    $i++;
  }
  ?>
<div style="width: 1000px;">
  <canvas id="myChart"></canvas>
</div>
 
<script>
  // === include 'setup' then 'config' above ===
  
  const labels = <?php echo json_encode($clo) ?>;
  const data = {
    labels: labels,
    datasets: [{
        type: 'line',
    label: 'Average',
      data: <?php echo json_encode($avg) ?>,
      backgroundColor: [
    //     'rgba(255, 99, 132, 0.2)',
    //     'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86)',
    //     'rgba(75, 192, 192, 0.2)',
    //     'rgba(54, 162, 235, 0.2)',
    //     'rgba(153, 102, 255, 0.2)',
    //     'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        // 'rgb(255, 99, 132)',
        // 'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        // 'rgb(75, 192, 192)',
        // 'rgb(54, 162, 235)',
        // 'rgb(153, 102, 255)',
        // 'rgb(201, 203, 207)'
      ],
      borderWidth: 3},{
        type: 'bar',
      label: 'Maximum',
      data: <?php echo json_encode($max) ?>,
      backgroundColor: [
        'rgba(255, 99, 132)',
        // 'rgba(255, 159, 64, 0.2)',
        // 'rgba(255, 205, 86, 0.2)',
        // 'rgba(75, 192, 192, 0.2)',
        // 'rgba(54, 162, 235, 0.2)',
        // 'rgba(153, 102, 255, 0.2)',
        // 'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        // 'rgb(255, 159, 64)',
        // 'rgb(255, 205, 86)',
        // 'rgb(75, 192, 192)',
        // 'rgb(54, 162, 235)',
        // 'rgb(153, 102, 255)',
        // 'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    },{
        type: 'bar',
    label: 'Minimum',
      data: <?php echo json_encode($min) ?>,
      backgroundColor: [
    //     'rgba(255, 99, 132, 0.2)',
    //     'rgba(255, 159, 64, 0.2)',
    //     'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192)',
    //     'rgba(54, 162, 235, 0.2)',
    //     'rgba(153, 102, 255, 0.2)',
    //     'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        // 'rgb(255, 99, 132)',
        // 'rgb(255, 159, 64)',
        // 'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
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