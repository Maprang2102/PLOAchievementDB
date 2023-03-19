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
    require('./select.php');
    // require('./chart_test.php');
    // require('./chart_bar.php');
    require('./chart_stu_bar.php');
    require('./chart_stu_radar.php');
    // require('./chart_bar_plo.php');
    // require('./chart_bar_plo_cou.php');
    ?>
    <div class="container">
        <div class="box">
            <h4>กราฟ</h4>
            <hr>

            <!-- sort data รายวิชา/หลักสูตร หลักสูตรอะไร/วิชาอะไร  -->
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกหลักสูตร/รายวิชา</option>
                <option value="?group=1" <?php if(@$_GET['group'] == 1) echo 'selected'?> >หลักสูตร</option>
                <option value="?group=2" <?php if(@$_GET['group'] == 2) echo 'selected'?>>รายวิชา</option>
            </select>
            <?php
            @$group = $_GET['group'];
            if ($group == 1) {
                select_program_showchart();
                @$points = $_GET["program_id"];
            } elseif ($group == 2) {
                select_course_section_showchart();
                @$points = $_GET["year"];
            }
            ?>

        </div>
    </div>
    <?php 
    if (@$points) { ?>
        <div class="container">
            <div class="box">
                <div class="row justify-content-start">

                    <form method="post">
                        <button type="submit" class="btn btn-outline-primary" name="polarchart">กราฟใยแมงมุม</button>
                        <button type="submit" class="btn btn-outline-primary" name="barchart">กราฟแท่ง</button>
                    </form>

                    <?php
                    // $subgroup = $_GET['subgroup'];
                    // include 'calculate.php';
                    // group_separate($group, $subgroup);
                    // $group_name;
                    // $group_number 

                    // @$type = $_post['type_chart'];
                    if (isset($_POST['polarchart'])&&$group==1) {
                        chart_radar_plo();
                    } 
                    elseif (isset($_POST['barchart'])&&$group==1) {
                        chart_bar_plo();
                    }
                    elseif (isset($_POST['polarchart'])&&$group==2) {
                        chart_radar_clo();
                    } 
                    elseif (isset($_POST['barchart'])&&$group==2) {
                        chart_bar_clo();
                        // "<br>".
                        // chart_bar_plo_cou();
                    }
                    ?>
                </div>
            </div>
        </div>

    <?php } ?>
</body>

</html>