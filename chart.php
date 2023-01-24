<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include './navbar.php';
    require('./connect_program.php');
    ?>
    <div class="container">
        <div class="box">
            <h4>กราฟ</h4>
            <hr>
            <!-- sort data รายวิชา/หลักสูตร หลักสูตรอะไร/วิชาอะไร  -->
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกหลักสูตร/รายวิชา</option>
                <option value="?group=1">หลักสูตร</option>
                <option value="?group=2">รายวิชา</option>
            </select><br>
            <?php
            @$group = $_GET['group'];
            if ($group == 1) {
                $group_name = "program_name";
                $group_number = "id_program";
                $query = "SELECT * FROM program ";
            } elseif ($group == 2) {
                $group_name = "course_name";
                $group_number = "course_id";
                $query = "SELECT * FROM course_in_program ";
            }
            ?>
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกหลักสูตร/รายวิชา</option>
                <?php
                $sql = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="?group=<?php echo $group ?>&subgroup=<?php echo $row[$group_number] ?>"><?php echo $row[$group_name]; ?></option>
                <?php }
                @$subgroup = $_GET['subgroup']; ?>
            </select>
        </div>
    </div>
    <?php if (@$subgroup) { ?>
        <div class="container">
            <div class="box">
                <div class="row justify-content-start">
                    <div class="col-4">
                        <select class="form-select" onchange="location = this.value;">
                            <option value="">ประเภทของกราฟ</option>
                            <option value="?group=<?php echo $group ?>&subgroup=<?php echo $subgroup ?>&type=polarchart">Polar Area Chart</option>
                            <option value="?group=<?php echo $group ?>&subgroup=<?php echo $subgroup ?>&type=barchart">Bar Chart</option>
                        </select>
                    </div>
                    <div class="col-8" style="height:50rem;">
                        <?php
                        // $subgroup = $_GET['subgroup'];
                        // include 'calculate.php';
                        // group_separate($group, $subgroup);
                        // $group_name;
                        // $group_number 

                        @$type = $_GET['type'];
                        if ($type == 'polarchart') {
                            "<div style='width: 100px; height: 100px;'>" .
                                // require('./polar_chart.php');
                                require('./chart_polar.php');
                            "</div>";
                        } elseif ($type == 'barchart') {
                            require('./chart_bar.php');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>