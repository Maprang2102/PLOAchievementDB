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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
</head>

<body>
<?php
    require ('./navbar.php');
    require('./connect_program.php');
    require('./select.php');
    require('./input.php');
    require('./table.php');
    $value = 0;
    ?>
    <div class="container">
        <div class="box">
        <?php
            @$program = $_GET['program_id'];
            @$course = $_GET['course'];
            @$section = $_GET['section'];
            @$semester = $_GET['semester'];
            @$year = $_GET['year'];
            @$course_pro = mysqli_query($connect, "SELECT * FROM program WHERE program_id ='$program'");
            while ($name_pro = mysqli_fetch_array($course_pro)) {
                $program_name = $name_pro['program_name'];
            }
            @$course_cou = mysqli_query($connect, "SELECT * FROM course WHERE course_id ='$course'");
            while ($name_cou = mysqli_fetch_array($course_cou)) {
                $course_name = $name_cou['course_name'];
            }
            @$course_sec = mysqli_query($connect, "SELECT * FROM section WHERE section_id ='$section'");
            while ($name_sec = mysqli_fetch_array($course_sec)) {
                $section_name = $name_sec['section_name'];
            }
            @$course_sem = mysqli_query($connect, "SELECT * FROM semester WHERE semester_id ='$semester'");
            while ($name_sem = mysqli_fetch_array($course_sem)) {
                $semester_name = $name_sem['semester_name'];
            }
            ?>
            <h4>Assignment : <?php echo "".@$program_name." -".@$course_name." -".@$section_name." -".@$semester_name." -".@$year; ?></h4>
            <?php select_course_section(); ?>
        </div>
    </div>
    <div class="container">
        <div class="box" style="font-size:20px; overflow: auto;">
            <form method="post" style="justify-content: flex-end; display: flex;">
                <input class="btn btn-outline-primary" type="submit" name="input_assignment" value="Add Assignment" />
                <input class="btn btn-outline-primary" type="submit" name="input_sudassign" value="Add Sub assignment" style="margin-left: 16px;"/>
                <input class="btn btn-outline-primary" type="submit" name="import_excel" value="Upload Excel" style="margin-left: 16px;" />
                <!-- <input class="btn btn-outline-primary" type="submit" name="edit_table" value="Edit Table" style="margin-left:16px;" onclick="undisable() " /> -->
                <br>
            </form>
            <?php
            if (isset($_POST['input_assignment'])) {
                input_Assignment();
            }
            if (isset($_POST['import_excel'])) {
                importfile();
            }
            if (isset($_POST['input_sudassign'])) {
                input_Subassign();
            }
            require('./accordion_table_test.php');
            accordion_table();

            ?>
        </div>
    </div>
</body>

</html>