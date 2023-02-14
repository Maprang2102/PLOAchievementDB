<?php
function input_PLO()
{
    $pointer = @$_GET['program_id'];
    $table = "plo";
    $sub_table = "program_id";
    $insertData = "insertData_plo.php";
    $show = "PLO";
    $show_id = "plo_code";
    $show_name = "plo_name";
    $show_name1 = "";
    $show_else = "หลักสูตร";
    $table = "SELECT `plo`.`plo_name`,`plo`.`plo_code`,`plo`.`plo_id`  FROM `program_plo` 
    LEFT JOIN  `plo`  
    ON   `plo`.plo_id = `program_plo`.plo_id 
    Where `program_plo`.`program_id`  ='$pointer' ";
    require('./connect_program.php');
    echo "<h4>เพิ่ม " . $show . "</h4>" ?>
    <form action="<?php echo $insertData ?>" method="POST">
        <div class="input-group mb-3">
            <input type="hidden" class="form-control" name="<?php echo $sub_table ?>" value="<?php echo $pointer  ?> ">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อ ' . $show ?>" name="<?php echo $show_id ?>">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อมูล ' . $show ?>" name="<?php echo $show_name ?>">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อมูล ' . $show ?>" name="<?php echo $show_name1 ?>">
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnAdd">Add</button>
        </div>
        <div class="input-group mb-3">
            <select name="Ploid" class="form-select">
                <option value="">เลือกข้อ</option>
                <?php
                $sql = mysqli_query($connect, $table);
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="<?php echo $row["plo_id"]; ?> "><?php echo $row["plo_code"]; ?></option>
                <?php }
                // $course_id = $_GET['course_id'] 
                ?>
            </select>
            <!-- <input type="hidden" class="form-control" placeholder="ID Course" name="editId" value="<?php echo $_ ?>" /> -->
            <input type="text" class="form-control" placeholder="PLO Name Thai" name="editName" />
            <input type="text" class="form-control" placeholder="PLO Name eng" name="editNameeng" />
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnEdit">Edit</button>
        </div>
    </form>
    <hr>
<?php
    // input_test($pointer, $table, $sub_table, $insertData, $show, $show_id, $show_name,$show_name, $show_else);
}
function input_CLO()
{
    $pointer = @$_GET['year'];
    require('./connect_program.php'); 
    $table = "SELECT `clo`.`clo_name`,`clo`.`clo_code`,`clo`.`clo_id`  FROM `course_clo` 
    LEFT JOIN  `clo`  
    ON   `clo`.clo_id = `course_clo`.clo_id 
    Where `course_clo`.`year_str`  ='$pointer' "; ?>
    <h4>CLO</h4>
    <form action="insertData_clo.php" method="POST">
        <div class="input-group mb-3">
            <input type="hidden" class="form-control" name="course_id" value="<?php echo $_GET['course']  ?> ">
            <input type="text" class="form-control" placeholder="Number" name="clo_code">
            <input type="text" class="form-control" placeholder="Name Thai" name="clo_name">
            <input type="text" class="form-control" placeholder="Name Eng" name="clo_nameeng">
            <input type="hidden" class="form-control" placeholder="Year" name="clo_year" value="<?php echo $_GET['year']  ?> ">
            <input type="hidden" class="form-control" placeholder="Semester" name="semester" value="<?php echo $_GET['semester']  ?>">
            <input type="hidden" class="form-control" placeholder="Section" name="section" value="<?php echo $_GET['section']  ?>">
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnAdd">Add</button>
        </div>
        <div class="input-group mb-3">
            <select name="Ploid" class="form-select">
                <option value="">เลือกข้อ</option>
                <?php
                $sql = mysqli_query($connect, $table);
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="<?php echo $row["clo_id"]; ?> "><?php echo $row["clo_code"]; ?></option>
                <?php }
                // $course_id = $_GET['course_id'] 
                ?>
            </select>
            <!-- <input type="hidden" class="form-control" placeholder="ID Course" name="editId" value="<?php echo $_ ?>" /> -->
            <input type="text" class="form-control" placeholder="CLO Name Thai" name="editName" />
            <input type="text" class="form-control" placeholder="CLO Name eng" name="editNameeng" />
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnEdit">Edit</button>
        </div>
    </form>
    <hr>
<?php
}
function input_Assignment()
{
    $pointer = @$_GET['course'];
    $table = "assignment";
    $sub_table = "course_id";
    $insertData = "insertData_assignment.php";
    $show = "Assignment";
    $show_id = "-";
    $show_name = "assign_name";
    $show_name1 = "";
    $show_else = "รายวิชา";
    require('./connect_program.php');
    echo "<h4>เพิ่ม " . $show . "</h4>" ?>
    <form action="<?php echo $insertData ?>" method="POST">
        <div class="input-group mb-3">
            <input type="hidden" class="form-control" name="<?php echo $sub_table ?>" value="<?php echo $pointer  ?> ">
            <input type="hidden" class="form-control" name="teacher_id" value="62363660">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อมูล ' . $show ?>" name="assign_name">
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnAdd">Add</button>
        </div>
    </form>
    <hr>
<?php
    // input_test($pointer, $table, $sub_table, $insertData, $show, $show_id, $show_name, $show_name1, $show_else);
}
function input_Subassign()
{
    $pointer = @$_GET['course'];
    $table = "assignment";
    $sub_table = "course_id";
    $insertData = "insertData_topic.php";
    $show = "Assignment";
    $show_id = "-";
    $show_name = "assign_name";
    $show_name1 = "";
    $show_else = "รายวิชา";
    require('./connect_program.php');
    echo "<h4>เพิ่ม " . $show . "</h4>" ?>
    <form action="insertData_topic.php" method="POST">
        <div class="input-group mb-3">
            <select class="form-select" name="assign_id">
                <option value="">เลือกหัวข้อหลัก</option>
                <?php $query = "SELECT * FROM assignment WHERE course_id='$pointer' ";
                $sql = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="<?php echo $row["assign_id"]; ?> "><?php echo $row["assign_name"]; ?></option>
                <?php } ?>
            </select>
            <input type="text" class="form-control" placeholder="กรุณากรอก Assignment" name="topic">
            <input type="text" class="form-control" placeholder="กรุณากรอกข้อมูลค่าน้ำหนัก" name="weight">
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnAdd">Add</button>
        </div>
    </form>
    <hr>
<?php
    // input_test($pointer, $table, $sub_table, $insertData, $show, $show_id, $show_name, $show_name1, $show_else);
}
function input_test($pointer, $table, $sub_table, $insertData, $show, $show_id, $show_name, $show_name1, $show_else)
{
    require('./connect_program.php');
    echo "<h4>เพิ่ม " . $show . "</h4>" ?>
    <form action="<?php echo $insertData ?>" method="POST">
        <div class="input-group mb-3">
            <input type="hidden" class="form-control" name="<?php echo $sub_table ?>" value="<?php echo $pointer  ?> ">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อ ' . $show ?>" name="<?php echo $show_id ?>">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อมูล ' . $show ?>" name="<?php echo $show_name ?>">
            <input type="text" class="form-control" placeholder="<?php echo 'กรุณากรอกข้อมูล ' . $show ?>" name="<?php echo $show_name1 ?>">
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnAdd">Add</button>
        </div>
        <div class="input-group mb-3">
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือกข้อ</option>
                <?php $query = "SELECT * FROM course ";
                $sql = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="?course_id=<?php echo $row["course_id"]; ?> "><?php echo $row["course_name"]; ?></option>
                <?php }
                $course_id = $_GET['course_id'] ?>
            </select>
            <input type="hidden" class="form-control" placeholder="ID Course" name="editId" value="<?php echo $course_id ?>" />
            <input type="text" class="form-control" placeholder="ID Course" name="editcode" />
            <input type="text" class="form-control" placeholder="Course Name Thai" name="editName" />
            <input type="text" class="form-control" placeholder="Course Name eng" name="editNameeng" />
            <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnEdit">Edit</button>
        </div>
    </form>
    <hr>

<?php }
function importfile()
{ ?>
    <h4> อัปโหลดไฟล์ Excel </h4>
    <div class="input-group mb-3">
        <input type="file" class="form-control" id="inputGroupFile02">
        <label class="input-group-text" for="inputGroupFile02">Upload</label>
    </div>
    <hr>
<?php
}
function add_student(){ 
    require('./connect_program.php');
    $select = '';
    ?>
    <h4>เพิ่มนิสิต</h4>
    <form action="add_student_course_sql.php" method="POST">
    <div class="input-group mb-3">
        <select class="form-select" name="student_id">
            <option value="">เลือกนิสิต</option>
            <?php $program = $_GET['program_id'];
            $query = "SELECT * FROM student WHERE program_id='$program' ";
            $sql = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($sql)) {
            ?>
                <option value="<?php echo $row["student_id"]; ?> "><?php echo $row["fname"]." ".$row["lname"]; ?></option>
            <?php } ?>
        </select>
        <input type="hidden" name="course" value="<?php echo $_GET["course"]?>">
        <input type="hidden" name="semester" value="<?php echo $_GET["semester"]?>">
        <input type="hidden" name="section" value="<?php echo $_GET["section"]?>">
        <input type="hidden" name="year" value="<?php echo $_GET["year"]?>">
        <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnAdd">Add</button>
    </div>
</form>
<hr>
<?php
} 
?>