<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<canvas id="myChartAxis" height="90"></canvas>

<script>
    new Chart(document.getElementById('myChartAxis'), {
        type: 'polarArea',
        data: {
            labels: ['A', 'B', 'C', 'D'],
            datasets: [{
                    label: 'WARNINGS',
                    data: [0, 2, 3, 2],
                    borderDash: [5],
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: 'rgba(255, 159, 64, 0)',
                    fill: false
                },
                {
                    label: 'ERRORS',
                    data: [1, 1, 4, 3],
                    borderDash: [2],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: false
                }
            ]
        },
        options: {
            legend: {
                labels: {
                    generateLabels: chart => chart.data.datasets.map((dataset, i) => ({
                        datasetIndex: i,
                        text: dataset.label,
                        fillStyle: dataset.backgroundColor,
                        strokeStyle: dataset.borderColor
                    }))
                }
            },
            showTooltips: true,
            responsive: true,
            plugins: {
          legend: {
            display: true,
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
</script>