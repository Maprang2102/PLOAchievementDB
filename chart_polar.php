<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<!-- </head> -->
<?php
// require('./connect_program.php');
// $query = "SELECT * FROM assignment ";
// $sql = mysqli_query($connect, $query);
// foreach ($sql as $data) {
//   // $maximum_point[] = $data['maximum_point'];
//   // $weight_value[] = $data['weight_value'];
//   $assignment_number[] = $data['assignment_number'];
//   $weight[] = ($data['point'] * $data['weight_value']) / 100;
// }
?>

<!-- <body> -->
  <?php 
  function chart_polar(){ 
    $value_full=0;
  $value_max=0;
  $value_min=0;
  $value_avg=0;?>
    <div class="row md-8 center">
      <div class="col-7">
      <canvas id="myChart" width="500px" height="500px"></canvas>
      </div>
      <div class="col-2">
      <input class="btn btn-outline-primary" id="btn-full" type="button" value="<?php echo ($value_full==0)? "Full Score":"show" ?>">
      <input class="btn btn-outline-primary" id="btn-max" type="button" value="Maximum">
      <input class="btn btn-outline-primary" id="btn-min" type="button" value="Minimun">
      <input class="btn btn-outline-primary" id="btn-avg" type="button" value="Average">
      </div>
    </div>
    
  <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
      type: 'polarArea',
      data: {
        // labels: <?php //echo  json_encode($assignment_number);  ?>,
        datasets: [{
            // display: true,
            // showLine: false,
            data: [
              3,
              7,
              3,
              4,
              12,
              7,
              8
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
            // display: true,
            // showLine: true,
            data: [
              8,
              11,
              5,
              5,
              15,
              7,
              10
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
            // display: true,
            // showLine: true,
            data: [
              14,
              15,
              10,
              7,
              18,
              11,
              19
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
              15,
              18,
              15,
              10,
              20,
              16,
              20
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
        labels: [
          "CLO1",
          "CLO2",
          "CLO3",
          "CLO4",
          "CLO5",
          "CLO6",
          "CLO7",
        ]
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


      }

    });
    $("#btn-full").on("click", function() {
      myChart.data.datasets[3].data = null;
      myChart.update();
      <?php $value_full=1; ?>
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