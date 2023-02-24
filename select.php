<?php
function select_course()
{
    @$id = $_GET['program_id'];
    require('./connect_program.php');
    $query = "SELECT `course`.`course_name`,`course`.`course_id`,`course`.`course_code`  FROM `program_course` 
    LEFT JOIN  `course`  
    ON   `course`.course_id = `program_course`.course_id 
    Where `program_course`.`program_id`  ='$id' ";

    $lock_id = "SELECT * FROM courses WHERE course_id = '$id'";
    $sql_lock = mysqli_query($connect, $lock_id);
    $sql = mysqli_query($connect, $query);

    if ($id == 1) {
        echo "รายวิชา "; ?>
        <br>
        <form method='POST' action='insertData_course.php'>
            <div class='input-group mb-3'>
                <select class="form-select" onchange="location = this.value;">
                    <option value="">เลือกรายวิชา</option>
                    <?php
                    $program = "SELECT * FROM program ";
                    $sql_program = mysqli_query($connect, $program);
                    while ($row = mysqli_fetch_array($sql_program)) { ?>
                        <option value="?course_id=1&add_id_program=<?php echo $row["program_id"]; ?> "><?php echo $row["program_name"]; ?> </option>
                    <?php } ?>
                </select>
                <input type="hidden" class="form-control" name="id_program_clo" value="<?php echo @$_GET['add_id_program']; ?> ">
                <input type="number" class="form-control" placeholder="รหัสวิชา" name="course_id">
                <input type="text" class="form-control" placeholder="ชื่อวิชา" name="course_name">
                <button class="btn btn-outline-primary" type="submit" value="Submit">Submit</button>
            </div>
        </form>
    <?php } else if ($id) {
        while ($row = mysqli_fetch_array($sql_lock)) {
            echo "รายวิชา : " . $row['course_id'] . " " . $row['course_name'] . "";
        }
    } else {
        echo "รายวิชา";
    } ?>
    <hr>
    <select class="form-select" onchange="location = this.value;">
        <option value="">เลือกรายวิชา</option>
        <?php while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="course.php?course_id=<?php echo $row["course_id"]; ?>"><?php echo $row["course_name"]; ?></option>
        <?php } ?>
        <option value="course.php?course_id=1">อื่นๆ</option>
    </select>


<?php
} ?>

<?php
function select_program()
{
    @$program_id = $_GET['program_id'];
    require('./connect_program.php');
    $query = "SELECT * FROM program ";
    $lock_id = "SELECT * FROM program WHERE program_id = '$program_id'";
    $sql_lock = mysqli_query($connect, $lock_id);
    $sql = mysqli_query($connect, $query);

    if ($program_id) {
        while ($row = mysqli_fetch_array($sql_lock)) {
            echo "หลักสูตร : " . $row['program_name'] . "";
        }
    } else {
        echo "หลักสูตร";
    } ?>
    <hr>
    <select class="form-select" onchange="location = this.value;">
        <option value="">เลือกหลักสูตร</option>
        <?php while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="?program_id=<?php echo $row["program_id"]; ?> " <?php if($row["program_id"] === $program_id) echo 'selected'?>><?php echo $row["program_name"]; ?></option>
        <?php } ?>
    </select>
<?php 
} ?>

<?php function select_course_section()
{
    @$program_id = $_GET['program_id'];
    @$course_id = $_GET['course'];
    @$section_id = $_GET['section'];
    @$semester = $_GET['semester'];
    @$year = $_GET['year'];
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
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกหลักสูตร</option>
                <?php while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="?program_id=<?php echo $row["program_id"]; ?> " <?php if($row["program_id"] === $program_id) echo 'selected'?> ><?php echo $row["program_name"]; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-6">
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกรายวิชา</option>
                <?php @$program_id = $_GET['program_id'];
                while ($row = mysqli_fetch_array($sql_course)) {
                ?>
                    <option value="?program_id=<?php echo $program_id; ?>&course=<?php echo $row["course_id"]; ?>" <?php if($row["course_id"] === $course_id) echo 'selected'?> ><?php echo $row["course_name"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" onchange="location = this.value;">
                <option>เลือกกลุ่มเรียน</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_section)) { ?>
                    <option value="?program_id=<?php echo $program_id; ?>&course=<?php echo $course_id ?>&section=<?php echo $row["section_id"]; ?>" <?php if($row["section_id"] === $section_id) echo 'selected'?> ><?php echo $row["section_name"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" onchange="location = this.value;">
                <option>เลือกภาคเรียน</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_semester)) { ?>
                    <option value="?program_id=<?php echo $program_id; ?>&course=<?php echo $course_id ?>&section=<?php echo $section_id ; ?>&semester=<?php echo $row["semester_id"]; ?>" <?php if($row["semester_id"] === $semester) echo 'selected'?>><?php echo $row["semester_name"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" onchange="location = this.value;">
                <option>เลือกปีการศึกษา</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_year)) { ?>
                    <option value="?program_id=<?php echo $program_id; ?>&course=<?php echo $course_id ?>&section=<?php echo $section_id ; ?>&semester=<?php echo $semester;?>&year=<?php echo $row['year_str'];?>" <?php if($row["year_str"] === $year) echo 'selected'?>><?php echo $row["year_str"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
    </div>
<?php
} 

function select_program_showchart()
{
    @$program_id = $_GET['program_id'];
    require('./connect_program.php');
    $query = "SELECT * FROM program ";
    $lock_id = "SELECT * FROM program WHERE program_id = '$program_id'";
    $sql_lock = mysqli_query($connect, $lock_id);
    $sql = mysqli_query($connect, $query);

    // if ($id) {
    //     while ($row = mysqli_fetch_array($sql_lock)) {
    //         echo "หลักสูตร : " . $row['program_name'] . "";
    //     }
    // } else {
    //     echo "หลักสูตร";
    // } ?>
    <hr>
    <select class="form-select" onchange="location = this.value;">
        <option value="">เลือกหลักสูตร</option>
        <?php while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="?group=<?php echo $_GET['group'] ?>&program_id=<?php echo $row["program_id"]; ?> " <?php if($row["program_id"] === $program_id) echo 'selected'?>><?php echo $row["program_name"]; ?></option>
        <?php } ?>
    </select>
<?php 
} ?>

<?php function select_course_section_showchart()
{
    @$course_id = $_GET['course'];
    @$section_id = $_GET['section'];
    @$semester = $_GET['semester'];
    @$year = $_GET['year'];
    require('./connect_program.php');
    $query = "SELECT * FROM program ";

    $query_course =  "SELECT `course`.`course_name`,`course`.`course_id`,`course`.`course_code`  FROM  `course`  ";

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
        <div class="col-6">
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกรายวิชา</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_course)) {
                ?>
                    <option value="?group=<?php echo $_GET['group'] ?>&course=<?php echo $row["course_id"]; ?>" <?php if($row["course_id"] === $course_id) echo 'selected'?>><?php echo $row["course_name"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" onchange="location = this.value;">
                <option>เลือกกลุ่มเรียน</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_section)) { ?>
                    <option value="?group=<?php echo $_GET['group'] ?>&course=<?php echo $course_id ?>&section=<?php echo $row["section_id"]; ?>" <?php if($row["section_id"] === $section_id) echo 'selected'?>><?php echo $row["section_name"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" onchange="location = this.value;">
                <option>เลือกภาคเรียน</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_semester)) { ?>
                    <option value="?group=<?php echo $_GET['group'] ?>&course=<?php echo $course_id ?>&section=<?php echo $section_id ; ?>&semester=<?php echo $row["semester_id"]; ?>" <?php if($row["semester_id"] === $semester) echo 'selected'?>><?php echo $row["semester_name"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" onchange="location = this.value;">
                <option>เลือกปีการศึกษา</option>
                <?php 
                while ($row = mysqli_fetch_array($sql_year)) { ?>
                    <option value="?group=<?php echo $_GET['group'] ?>&course=<?php echo $course_id ?>&section=<?php echo $section_id ; ?>&semester=<?php echo $semester;?>&year=<?php echo $row['year_str'];?>" <?php if($row["year_str"] === $year) echo 'selected'?>><?php echo $row["year_str"]; ?></option>
                <?php } ?>
                <!-- <option value="chart.php?group=2">รายวิชา</option> -->
            </select>
        </div>
    </div>
<?php
} ?>

<?php function select_edit_program(){
    require('./connect_program.php');
    $query = "SELECT * FROM programs ";
    $sql = mysqli_query($connect, $query);

    if ($id) {
        while ($row = mysqli_fetch_array($sql_lock)) {
            echo "หลักสูตร : " . $row['program_name'] . "";
        }
    } else {
        echo "หลักสูตร";
    } ?>
    <hr>
    <select class="form-select" onchange="location = this.value;">
        <option value="">เลือกหลักสูตร</option>
        <?php while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="?program_id=<?php echo $row["program_id"]; ?> "><?php echo $row["program_name"]; ?></option>
        <?php } ?>
    </select>
<?php } ?>