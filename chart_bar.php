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
<?php
require('./connect_program.php');
$query = "SELECT * FROM assignment ";
$sql = mysqli_query($connect, $query);
foreach ($sql as $data) {
  // $maximum_point[] = $data['maximum_point'];
  // $weight_value[] = $data['weight_value'];
  $assignment_number[] = $data['assignment_number'];
  $weight[] = ($data['point'] * $data['weight_value']) / 100;
}
?>
<div class="col-md-8">
    <canvas id="myChart" width="100" height="100"></canvas>
  </div>
  <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart1 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo  json_encode($assignment_number);  ?>, 
        datasets: [{
          label: 'CLO',
          data: <?php echo json_encode($weight) ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
    });
  </script>
  <script>
    const myChart = new Chart(
      document.getElementById('myChart1'),
      config
    );
  </script>
</body>
</html>