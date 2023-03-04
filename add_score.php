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
    <style>
        table,
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    require('./navbar.php');
    require('./connect_program.php');
    require('./select.php');
    $sql = "SELECT * FROM assignment WHERE assignment_id ='$'";

    ?>
    <div class="container">
        <div class="box">
            <?php
            @$program = $_GET['program_id'];
            @$course = $_GET['course'];
            @$section = $_GET['section'];
            @$semester = $_GET['semester'];
            @$year = $_GET['year'];
            @$assignment = $_GET['assignment'];
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
            <h4>Score : <?php echo "" . @$program_name . " -" . @$course_name . " -" . @$section_name . " -" . @$semester_name . " -" . @$year; ?></h4>
            <?php select_course_section();
            @$assign = "SELECT * FROM assignment WHERE course_id='$course'";
            $sql_table1 = mysqli_query($connect, $assign); ?>
            <div class="row ">
                <div class="col-12 g-4">
                    <select class="form-select " onchange="location = this.value;">
                        <option value="">เลือกAssignment</option>
                        <?php while ($assign1 = mysqli_fetch_array($sql_table1)) {
                        ?>
                            <option value="?program_id=<?php echo $program; ?>&course=<?php echo $course ?>&section=<?php echo $section; ?>&semester=<?php echo $semester; ?>&year=<?php echo $year; ?>&assignment=<?php echo $assign1["assign_id"]; ?>"<?php if($assign1["assign_id"] === $assignment) echo 'selected'?>><?php echo $assign1["assign_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>

        </div>
    </div>
    <?php if (isset($assignment)) { ?>
        <div class="container">
            <div class="box">
                <?php $sub_assign = "SELECT * FROM sub_assignment WHERE assign_id='$assignment'";
                $clo = "SELECT `clo`.`clo_name`,`clo`.`clo_id`,`clo`.`clo_code`  
         FROM `course_clo` LEFT JOIN  `clo` ON `clo`.clo_id = `course_clo`.clo_id 
         Where `course_clo`.`course_id`  = '$course' AND `course_clo`.`year_str`='$year' ";
                $clo_table = mysqli_query($connect, $clo);
                $sql_table1 = mysqli_query($connect, $sub_assign);
                $count_clo = mysqli_num_rows($clo_table);
                $count_txt = 0;
                @$assignment_name = mysqli_query($connect, "SELECT * FROM assignment WHERE assign_id ='$assignment'");
            while ($assign_name = mysqli_fetch_array($assignment_name)) {
                $assign_name1 = $assign_name['assign_name'];
            }
                ?>
                <h4><?php echo $assign_name1; ?></h4><hr>
                <form method="post" action="add_score_sql.php">
                <input type="hidden" class="form-control" name="year" value="<?php echo $_GET['year']  ?> ">
                <input type="hidden" class="form-control" name="semester" value="<?php echo $_GET['semester']  ?>">
                <input type="hidden" class="form-control" name="section" value="<?php echo $_GET['section']  ?>">
                <input type="hidden" class="form-control" name="program_id" value="<?php echo $_GET['program_id'] ?>">
                <input type="hidden" class="form-control" name="course_id" value="<?php echo $_GET['course']  ?> ">
                <input type="hidden" class="form-control" name="assignment" value="<?php echo $_GET['assignment']  ?> ">
                    <table style='width:100%;' class="table table-hover ">
                        <thead style="background-color: #fff;">
                            <th rowspan="2">ชื่อ-นามสกุล</th>
                            <?php while ($assign1 = mysqli_fetch_array($sql_table1)) { ?>
                                <th>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th colspan="<?php echo $count_clo ?>"><?php echo $assign1['topic']; ?></th>
                                            <?php
                                            $sub_assign = $assign1['sub_assign_id'];  ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            $clo_assign = "SELECT `clo`.`clo_name`,`clo`.`clo_id`,`clo`.`clo_code` ,`clo_assignment`.`weight` 
                        FROM `clo_assignment` LEFT JOIN  `clo` ON `clo`.clo_id = `clo_assignment`.clo_id 
                        Where `clo_assignment`.`sub_assign_id`  = '$sub_assign' AND `clo_assignment`.`assign_id`='$assignment' ";
                                            $clo_table1 = mysqli_query($connect, $clo_assign);
                                            while ($assign2 = mysqli_fetch_array($clo_table1)) { ?>
                                                <th>CLO<?php echo $assign2['clo_code']." [". $assign2['weight'] ?>]</th>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </th>
                            <?php } ?>


                        </thead>
                        <tbody>
                            <?php
                            $student = mysqli_query($connect, "SELECT
                               student.`fname`,student.`lname`,student.`student_id`
                           FROM
                               student
                               INNER JOIN
                               student_score
                               ON 
                                   student.student_id = student_score.student_id
                               INNER JOIN
                               course
                               ON 
                                   course.course_id = student_score.course_id
                           WHERE
                               course.course_id = $course ");
                            ?>


                            <?php while ($stu_score = mysqli_fetch_array($student)) {  ?>
                                <tr>
                                    <td>
                                        <?php echo $stu_score['fname'] . " " . $stu_score['lname'];
                                        $student_id = $stu_score['student_id']; ?>
                                        
                                    </td>
                                    <?php $sub_assign1 = "SELECT * FROM sub_assignment WHERE assign_id='$assignment'";
                                    $sql_table2 = mysqli_query($connect, $sub_assign1);
                                    $count_clo1 = mysqli_num_rows($clo_table);
                                    while ($assign2 = mysqli_fetch_array($sql_table2)) {
                                        $sub_assign = $assign2['sub_assign_id']; ?>
                                        <th>
                                            <table class="table table-borderless">
                                                <?php
                                                $sub_assign = $assign2['sub_assign_id'];
                                                $score_stu_clo = "";
                                                $clo_assign1 = "SELECT `clo`.`clo_name`,`clo`.`clo_id`,`clo`.`clo_code`,`clo_assignment`.`clo_assign_id`
                        FROM `clo_assignment` LEFT JOIN  `clo` ON `clo`.clo_id = `clo_assignment`.clo_id 
                        Where `clo_assignment`.`sub_assign_id`  = '$sub_assign' AND `clo_assignment`.`assign_id`='$assignment' ";
                                                $clo_table2 = mysqli_query($connect, $clo_assign1);
                                                while ($assign3 = mysqli_fetch_array($clo_table2)) {
                                                    $clo_assign = $assign3['clo_assign_id'];
                                                    $score_stu = mysqli_query($connect, "SELECT * FROM student_sub_assign_score WHERE sub_assign_id='$sub_assign' AND clo_assign_id='$clo_assign' AND student_id='$student_id'");
                                                    while ($score = mysqli_fetch_array($score_stu)) {
                                                        $score_stu_clo = $score['score'];
                                                    } ?>
                                                    <th>
                                                        <input type="text" name="txt_sco<?php echo  $count_txt ?>" value="<?php echo $score_stu_clo ?>" style="width: 35px;margin-left:5px">
                                                        <input type="hidden" name="txt_sco_old<?php echo  $count_txt ?>" value="<?php echo $score_stu_clo ?>" style="width: 35px;margin-left:5px">
                                                        <input type="hidden" name="txt_sub<?php echo  $count_txt ?>" value="<?php echo $sub_assign ?>">
                                                        <input type="hidden" name="txt_clo_assign<?php echo  $count_txt ?>" value="<?php echo $clo_assign ?>">
                                                        <input type="hidden" name="txt_id<?php echo  $count_txt ?>" value="<?php echo $student_id ?>">
                                                        <input type="hidden" name="count_txt" value="<?php echo $count_txt ?>">
                                                    </th>
                                                <?php $score_stu_clo = "";$count_txt++; }
                                                 ?>
                                            </table>
                                        </th>
                                    <?php } ?>
                                </tr><?php } ?>
                        </tbody>
                    </table>
                    <div style="justify-content: flex-end; display: flex;">
                    <button class="btn btn-outline-primary" type="submit" name="btnSave">Save</button>
                    </div>
                </form>
            </div>
        </div> <?php } ?>
</body>

</html>