<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title> -->



<!-- </head> -->


<!-- <body> -->
<?php
function chart_polar()
{
  $avg = [];
  $max = [];
  $min = [];
  $j=0;
  require('./connect_program.php');
  $query = "SELECT DISTINCT `clo`.`clo_code`,`calculate_clo`.`clo_id` FROM calculate_clo LEFT JOIN clo ON `clo`.clo_id = `calculate_clo`.clo_id";
  $sql = mysqli_query($connect, $query);
  while ($row = mysqli_fetch_array($sql)) {
    $assignment_number[] = $row['clo_code'];
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
      echo "clo : " . $clo_code . number_format($sum_weight[$j], 4) . "<br>";
      echo "avg : " . $avg[$j] . " max : " . $max[$j] . " min : " . $min[$j]. "<hr>";
      $j++;
      // }
    }
  }
  print_r($sum_weight);
  // print_r($clo_weight);
  $value_full = 0;
  $value_max = 0;
  $value_min = 0;
  $value_avg = 0;
  $i = 1;
?>
  <div class="row md-8 center">
    <div class="col-7">
      <canvas id="myChart" width="500px" height="500px"></canvas>
    </div>
    <div class="col-2">
      <input class="btn btn-outline-primary" id="btn-full" type="button" value="<?php echo ($value_full == 0) ? "Full Score" : "show" ?>">
      <input class="btn btn-outline-primary" id="btn-max" type="button" value="Maximum">
      <input class="btn btn-outline-primary" id="btn-min" type="button" value="Minimun">
      <input class="btn btn-outline-primary" id="btn-avg" type="button" value="Average">
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
    // const ctx = document.getElementById('myChart').getContext('2d');
    const data = {
      type: 'polarArea',
      data: {
        labels: <?php echo  json_encode($assignment_number);  ?>, 
        datasets: [{
            data: [
              <?php echo json_encode($min); ?>
            ],
            backgroundColor: [
              'rgba(255,99,132,0.0)',
              'rgba(75, 192, 192, 0.0)',
              'rgba(255, 159, 64, 0.0)',
              'rgba(231, 233, 237, 0.0)',
              'rgba(54, 162, 235, 0.0)',
              'rgba(54, 100, 100, 0.0)'
            ],
            borderColor: "rgba(0, 110, 0, 1)",
            borderWidth: "3",
            label: 'Minimum', // for legend
          }, {
            data: [
              <?php echo json_encode($avg); ?>
            ],
            backgroundColor: [
              'rgba(255,99,132,0.0)',
              'rgba(75, 192, 192, 0.0)',
              'rgba(255, 159, 64, 0.0)',
              'rgba(231, 233, 237, 0.0)',
              'rgba(54, 162, 235, 0.0)',
              'rgba(54, 100, 100, 0.0)'
            ],
            borderDash: [5],
            borderColor: "rgba(0, 0, 0, 1)",
            borderWidth: "3",

            label: 'Average', // for legend
          }, {
            data: [
              <?php echo json_encode($max); ?>
            ],
            backgroundColor: [
              'rgba(255,99,132,0.0)',
              'rgba(75, 192, 192, 0.0)',
              'rgba(255, 159, 64, 0.0)',
              'rgba(231, 233, 237, 0.0)',
              'rgba(54, 162, 235, 0.0)',
              'rgba(54, 100, 100, 0.0)'
            ],
            borderColor: "rgba(255, 25, 80, 1)",
            borderWidth: "3",
            label: 'Maximum', // for legend
          }, {
            showLine: false,
            data: [
              <?php echo json_encode($sum_weight); ?>
            ],
            backgroundColor: [
              // 'rgba(208, 0, 25, 0.5)',
              // 'rgba(227, 156, 0, 0.6)',
              // 'rgba(229, 216, 0, 0.6)',
              // 'rgba(0, 198, 25, 0.6)',
              'rgba(0, 138, 226, 0.3)',
              // 'rgba(119, 0, 217, 0.6)'
            ],
            borderColor: "rgba(255, 255, 255, 0.0)",
            borderWidth: "1",
            label: 'Full Score' // for legend
          },


        ],

      },
      options: {
        showTooltips: true,
        responsive: true,
        plugins: {
          legend: {
            display: false,
          },
        },
        scales: {

          r: {
            angleLines: {
              display: true
            },
            // labels on the outside
            pointLabels: {
              display: true,
              centerPointLabels: true,
              font: {
                size: 14
              }
            },
            startAngle: 25,
            // grid: {}
            ticks: {
              z: 1,
            }
          },

        },
        layout: {
          padding: 1
        },

        // legend: {
        //display: false
        // },
        animation: {
          animateRotate: true

        },


      },

    };
    var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
    $("#btn-full").on("click", function() {
      if (value_full == 0) {
        document.getElementById("btn-full").value = "Show Full";
        myChart.data.datasets[3].data = null;
        myChart.update();
        value_full = 1;
      } else if (value_full == 1) {
        document.getElementById("btn-full").value = "Hide Full";
        myChart.data.datasets[3].data = 0;
        myChart.update();
        value_full = 0;
      }

    });
  </script>
<?php } ?>
<!-- <script>
    const _myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script> -->




<!-- </body>

</html> -->