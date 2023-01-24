<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course</title>
    <link rel="stylesheet" href="./css/page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./test.js"></script>
</head>
<!-- หน้าเก็บข้อมูล Assignment และเชื่อมกับ CLO -->

<body>
    <?php
    include './navbar.php';
    require('./connect_program.php');
    $query = "SELECT * FROM course_in_program";
    $sql = mysqli_query($connect, $query);
    ?>

    <div class="container">
        <div class="box">
            <?php require('./select.php');
            select_course(); ?>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <?php //แสดงรายวิชาที่เลือก
            @$id = $_GET['course_id'];
            if ($id) {
                $query = "SELECT * FROM course_in_program WHERE course_id = '$id'";
                $sql = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($sql)) {
                    echo $row['course_id'] . " " . $row['course_name'] . "<hr>";
                }
            } else {
                echo " ";
            } ?>
            <!-- ส่วนกรอกข้อมูลเพื่อเก็บ Assign -->
            <h4>&nbsp;&nbsp;Add Assignment</h4>
            <form action="insertData_topic.php" method="POST">
                <div class="input-group mb-3">
                    <input type="hidden" class="form-control" name="course_id" value="<?php echo @$_GET['course_id']; ?> ">
                    <input type="text" class="form-control" placeholder="Enter number" name="assignment_number">
                    <input type="text" class="form-control" placeholder="Enter Topic" name="assignment_name">
                    <input type="text" class="form-control" placeholder="Enter Detail" name="assignment_detail">
                    <input type="text" class="form-control" placeholder="Enter Score" name="maximum_point">
                    <input type="text" class="form-control" placeholder="กรุณากรอกค่าถ่วงน้ำหนัก" name="weight_value">
                    <button class="btn btn-outline-primary" type="submit" value="Submit">Add</button>
                </div> <!-- checkbox -->
                <?php
                @$id = $_GET['course_id'];
                if ($id) {
                    $query = "SELECT * FROM clo WHERE course_id = '$id'";
                    $sql = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($sql)) {
                        echo "
                                <div class='form-check form-check-inline' style='font-size:20px;'>
                                <input type='checkbox' class='form-check-input' name='link_clo_assign' value='$row[id_clo]' checked>
                                <label class='form-check-label' for='inlineCheckbox1'>CLO" . $row['id_clo'] . " : " . $row['clo_name'] . "
                                </label>
                                </div> 
                                ";
                    }
                } else {
                    echo " ";
                }
                ?>
            </form>
            <hr>
            <!--  ส่วนแสดงข้อมูล Assign ที่มีแล้ว -->
            <div style="font-size:20px;">
                <?php
                @$id = $_GET['course_id'];
                if ($id) { ?>
                    <table style='width:100%;' class="table table-hover">
                        <thead class="table-light">
                            <!-- หัวตาราง -->
                            <th>Number</th>
                            <th>Topic</th>
                            <th>Detail</th>
                            <th>Point</th>
                        </thead>
                    <?php
                    $query = "SELECT * FROM assignment WHERE course_id = '$id'";
                    $sql = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($sql)) {
                        echo //ส่วนในตาราง
                        '<a href="#"><tbody>
                          <td >&nbsp;&nbsp;' . $row["assignment_number"] . '</td>
                          <td>' . $row["assignment_name"] . '</td>
                          <td>' . $row["assignment_detail"] . '</td>
                          <td>' . $row["maximum_point"] . '</td>
                        </tbody></a>
                        ';
                    }
                } else {
                    echo "&nbsp;&nbsp;กรุณาเลือกหลักสูตร";
                }
                    ?>
                    </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="box" style="font-size:20px;">
            <?php // ส่วนเชื่อม Assign กับ clo
            @$id = $_GET['course_id'];
            @$assignment = $_GET['assignment'];
            $query = "SELECT * FROM assignment WHERE (assignment_number = '$assignment') AND (course_id = '$id')";
            $sql = mysqli_query($connect, $query);
            if ($assignment) {
                while ($row = mysqli_fetch_array($sql)) {
                    echo "Assignment : " . $row['assignment_name'] . "<br/>";
                }
            } else {
                echo "Assignment ";
            } ?>
            <select class="form-select" onchange="location = this.value;">
                <option value="">เลือก Assignment</option>
                <?php
                $query = "SELECT * FROM assignment WHERE course_id = '$id'";
                $sql = mysqli_query($connect, $query);
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <option value="topic.php?course_id=<?php echo $row["course_id"]; ?>&assignment=<?php echo $row["assignment_number"] ?>"><?php echo $row["assignment_name"]; ?></option>
                <?php } ?>
            </select>
            <hr>

            <form action="insertData_assignment.php" method="POST">
                <?php //เรียกข้อมูล Assign มาเป็นตัวเลือก
                @$id = $_GET['course_id'];
                @$assignment = $_GET['assignment'];
                $query = "SELECT * FROM assignment WHERE (assignment_number = '$assignment') AND (course_id = '$id')";
                $sql = mysqli_query($connect, $query);

                while ($row = mysqli_fetch_array($sql)) {
                    $link_plo_clo = explode(',', $row['link_plo_clo']); //แปลงจาก string -> Array โดยเอา ',' ออก
                    foreach ($link_plo_clo as $i) {
                        echo "CLO$i";
                        // กรอกรายละเอียด
                ?>
                        <div class="input-group mb-3">
                            <input type="hidden" class="form-control" name="clo_detail_number" value="<?php echo "$i" ?> ">
                            <input type="hidden" class="form-control" name="assignment_name" value="<?php echo "$assignment_name" ?> ">
                            <input type='text' class='form-control' placeholder='รายละเอียด' name='clo_detail'>
                            <input type='text' class='form-control' placeholder='คะแนน' name='clo_detail_point'>
                            <input type='text' class='form-control' placeholder='กรอกค่าถ่วงน้ำหนัก' name='clo_weight_value'>
                        </div>
                <?php };
                    echo '<button class="btn btn-outline-primary" type="submit" value="Submit">Add</button>';
                } ?>
            </form>
        </div>
    </div>

</body>

</html>