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
    require('./input.php');
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
            $i = 0;
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
            <!-- <div class="row ">
                <div class="col-12 g-4">
                    <select class="form-select " onchange="location = this.value;">
                        <option value="">เลือกAssignment</option>
                        <?php while ($assign1 = mysqli_fetch_array($sql_table1)) {
                        ?>
                            <option value="?program_id=<?php echo $program; ?>&course=<?php echo $course ?>&section=<?php echo $section; ?>&semester=<?php echo $semester; ?>&year=<?php echo $year; ?>&assignment=<?php echo $assign1["assign_id"]; ?>"><?php echo $assign1["assign_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div> -->
            <br>

        </div>
    </div>
    <?php if (isset($year)) { ?>
        <div class="container">
            <div class="box">
                <?php $sub_assign = "SELECT * FROM sub_assignment WHERE assign_id='$assignment'";
                $clo = "SELECT `clo`.`clo_name`,`clo`.`clo_id`,`clo`.`clo_code`  
         FROM `course_clo` LEFT JOIN  `clo` ON `clo`.clo_id = `course_clo`.clo_id 
         Where `course_clo`.`course_id`  = '$course' AND `course_clo`.`year_str`='$year' ";
                $clo_table = mysqli_query($connect, $clo);
                $sql_table1 = mysqli_query($connect, $sub_assign);
                $count_clo = mysqli_num_rows($clo_table);

                ?>
                <form method="post" style="justify-content: flex-end; display: flex;">
                    <input class="btn btn-outline-primary" type="submit" name="add_student" value="Add Student" />
                    <input class="btn btn-outline-primary" type="submit" name="import_excel" value="Upload Excel" style="margin-left: 16px;" />
                    <!-- <input class="btn btn-outline-primary" type="submit" name="edit_table" value="Edit Table" style="margin-left:16px;" onclick="undisable() " /> -->
                    <br>
                </form>
                <?php
                if (isset($_POST['add_student'])) {
                    add_student();
                }
                if (isset($_POST['import_excel'])) {
                    importfile();
                } ?>
                <form method="POST" action="add_student_course_sql.php">
                    <table style='width:100%;' class="table table-hover ">
                        <thead>
                            <tr>
                                <th>ลำดับที่</th>
                                <th>รหัสนิสิต</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $student = mysqli_query($connect, "SELECT
                               student.`fname`,student.`lname`,student.`student_id`,student_score.`student_score_id`
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
                               course.course_id = $course ORDER BY `student_score`.`student_id` ASC");
                            ?>


                            <?php while ($stu_score = mysqli_fetch_array($student)) {
                                $i++;  ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $stu_score['student_id'] ?></td>
                                    <td>
                                        <?php echo $stu_score['fname'] . " " . $stu_score['lname'] ?>
                                    </td>
                                    <td>
                                        <button type="submit" value="<?php echo $stu_score['student_score_id'] ?>" class="btn btn-danger delete" name="btnDelete"><i class='bx bx-trash'></i></button>
                                    </td>

                                </tr><?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div> <?php } ?>
</body>

</html>