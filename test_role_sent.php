<?php 
$program_id = $_POST['program_id'];
    $course_id = $_POST['course'];
    $section_id = $_POST['section'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];
    require('./connect_program.php');
    $query = "SELECT * FROM program ";

    $query_course =  "SELECT `course`.`course_name`,`course`.`course_id`,`course`.`course_code`  FROM `program_course` 
    LEFT JOIN  `course`  
    ON   `course`.course_id = `program_course`.course_id 
    Where `program_course`.`program_id`  ='$program_id' ";

    $sql = mysqli_query($connect, $query);

    $sql_course = mysqli_query($connect, $query_course);

    $query_section =  "SELECT `section`.`section_name`,`section`.`section_id`  FROM `program_course` 
    LEFT JOIN  `section`  
    ON   `section`.section_id = `program_course`.section_id 
    Where `program_course`.`course_id`  ='$course_id' ";

    $sql_section = mysqli_query($connect, $query_section);

    $query_semester =  "SELECT `semester`.`semester_name`,`semester`.`semester_id`  FROM `program_course` 
    LEFT JOIN  `semester`  
    ON   `semester`.semester_id = `program_course`.semester_id 
    Where `program_course`.`section_id`  ='$section_id' ";
    $sql_semester = mysqli_query($connect, $query_semester);

    $query_year =  "SELECT year_str FROM program_course WHERE course_id='$course_id'";
    $sql_year = mysqli_query($connect, $query_year);

     ?>
    <hr>
    <div class="row">
        <div class="col-12">
            <select class="form-select" name="program_id">
                <option value=""><?php (isset($program_id) ? "$program_id" : "เลือกหลักสูตร" ) ?></option>
                <?php while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="<?php echo $row["program_id"]; ?> "><?php echo $row["program_name"]; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <?php $program_id = $_POST['program_id'];
    echo "program= ".$program_id ?>
    <br>
    <div class="row">
        <div class="col-6">
            <select class="form-select" name="course">
                <option value="">เลือกรายวิชา</option>
                <?php @$program_id = $_POST['program_id'];
                while ($row = mysqli_fetch_array($sql_course)) {
                ?>
                    <option value="<?php echo $row["course_id"]; ?>"><?php echo $row["course_name"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" name="section">
                <option>เลือกกลุ่มเรียน</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_section)) { ?>
                    <option value="<?php echo $row["section_id"]; ?>"><?php echo $row["section_name"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" name="semester">
                <option>เลือกภาคเรียน</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_semester)) { ?>
                    <option value="<?php echo $row["semester_id"]; ?>"><?php echo $row["semester_name"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" name="year">
                <option>เลือกปีการศึกษา</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_year)) { ?>
                    <option value="<?php echo $row['year_str'];?>"><?php echo $row["year_str"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
    </div>