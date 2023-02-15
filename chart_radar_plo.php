<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>plo_bar</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php 
    // function chart_bar()
    // {
        require('./connect_program.php');
        $program = "1234";
        $i = 0;
        $final = 0;
        $tb_cal_plo = "SELECT DISTINCT `calculate_plo`.`plo_id` FROM `calculate_plo` LEFT JOIN `plo_clo`ON `calculate_plo`.`plo_id` = `plo_clo`.`plo_id` LEFT JOIN `program_plo`  ON `plo_clo`.`plo_id` = `program_plo`.`plo_id` WHERE `program_id` = '$program'";
        $count_plo = mysqli_query($connect, $tb_cal_plo);
        while ($count = mysqli_fetch_array($count_plo)) {
            $count_plo_id = $count['plo_id'];
            $fill_plo = mysqli_query($connect,"SELECT SUM(plo_weight) AS plo_weight FROM calculate_plo ");
            while ($sum_plo = mysqli_fetch_array($fill_plo)) {
                $sum_weight = $sum_plo['plo_weight'];
                echo "<hr>";
                $fill_weight = mysqli_query($connect,"SELECT DISTINCT plo_weight FROM calculate_plo WHERE plo_id = '$count_plo_id' ");
                while ($weight = mysqli_fetch_array($fill_weight)) {
                    $plo_weight = $weight['plo_weight'];
                    $final = number_format((($plo_weight/$sum_weight)+$final),4);
                    
                }echo "plo : ".$count_plo_id." plo : ".$plo_weight." sum : ".$sum_weight." final : ".$final."<br>";
                $final_sum[$i] = $final;
                $final = 0;
            }
            $calcu = mysqli_query($connect,"SELECT AVG(plo_weight) AS avg,MIN(plo_weight) AS min,MAX(plo_weight) AS max FROM calculate_plo WHERE plo_id = '$count_plo_id' ");
                while ($cal = mysqli_fetch_array($calcu)) {
                    $avg[$i] = number_format($cal['avg'],4);
                    $min[$i] = number_format($cal['min'],4);
                    $max[$i] = number_format($cal['max'],4);
                    $plo_show[$i] = "PLO".$count_plo_id;
                }
                $i++;
            // $count_std_id = $count['student_id'];
            // $quotient[$count_plo_id] = $product_plo[$count_std_id][$count_clo_id] / $sum_all;
            // echo $quotient[$count_plo_id] . "<hr>";
        }
    ?>
        <div style="width: 1000px;">
            <canvas id="myChart"></canvas>
        </div>

        <script>
            // === include 'setup' then 'config' above ===
            const labels = <?php echo json_encode($plo_show) ?>;
            const data = {
                labels: labels,
                datasets: [{
                        type: 'radar',
                        label: 'sum',
                        data: <?php echo json_encode($final_sum) ?>,
                        backgroundColor: [
                            //     'rgba(255, 99, 132, 0.2)',
                            //     'rgba(255, 159, 64, 0.2)',
                            //     'rgba(255, 205, 86, 0.2)',
                            //     'rgba(75, 192, 192, 0.2)',
                            //     'rgba(54, 162, 235, 0.2)',
                            // 'rgba(153, 102, 255, 0.1)',
                                'rgba(255, 255, 255, 0.1)'
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
                    }, {
                        type: 'radar',
                        label: 'Maximum',
                        data: <?php echo json_encode($max) ?>,
                          backgroundColor: [
                            'rgba(255, 255, 255, 0.1)'
                          ],
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
                    }, {
                        type: 'radar',
                        label: 'Minimum',
                        data: <?php echo json_encode($min) ?>,
                          backgroundColor: [
                            'rgba(255, 255, 255, 0.1)'
                          ],
                        borderColor: [
                            // 'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            // 'rgb(255, 205, 86)',
                            // 'rgb(75, 192, 192)',
                            // 'rgb(54, 162, 235)',
                            // 'rgb(153, 102, 255)',
                            // 'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    },
                    {
                        type: 'radar',
                        label: 'Average',
                        data: <?php echo json_encode($avg) ?>,
                          backgroundColor: [
                            'rgba(255, 255, 255, 0.1)'
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
                        borderWidth: 1
                    },
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
    <?php //} ?>
    <!-- <script>
    const myChart = new Chart(
      document.getElementById('myChart1'),
      config
    );
  </script> -->
</body>

</html>