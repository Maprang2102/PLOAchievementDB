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
<?php require("connect_program.php");
require("navbar.php");
?>

<body>
  <div class="container">
    <div class="box">
      <h3>เพิ่ม แก้ไข ลบ รายวิชา</h3>
      <hr>
      <h5>เพิ่มรายวิชา</h5>
      <form method="POST" action="edit_courses_sql.php">
        <div class="input-group mb-3">
        <select class="form-select" name="selectPro">
            <option value="">เลือกภาคเรียน</option>
            <?php $pro = "SELECT * FROM program ";
            $pro1 = mysqli_query($connect, $pro);
            while ($row1 = mysqli_fetch_array($pro1)) {
            ?>
              <option  value="<?php echo $row1['program_id']?>"><?php echo $row1["program_name"]; ?></option>
            <?php } ?>
          </select>
          <input type="text" class="form-control" placeholder="รหัสวิชา" name="txtId" />
          <input type="text" class="form-control" placeholder="ชื่อวิชา" name="txtNameth" />
          <input type="text" class="form-control" placeholder="ชื่อวิชา(Eng)" name="txtNameen" />
          <input type="text" class="form-control" placeholder="ปีการศึกษา" name="txtYear" />
          <input type="text" class="form-control" placeholder="กลุ่มเรียนที่" name="txtSec" />
          <select class="form-select" name="selectSemes">
            <option value="">เลือกภาคเรียน</option>
            <?php $sem = "SELECT * FROM semester ";
            $sem1 = mysqli_query($connect, $sem);
            while ($row1 = mysqli_fetch_array($sem1)) {
            ?>
              <option ><?php echo $row1["semester_name"]; ?></option>
            <?php } ?>
          </select>
          <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnSubmit">เพิ่มข้อมูล</button>
        </div>
        <hr>
        <h5>แก้ไขรายวิชา</h5>
        <div class="input-group mb-3">
          <select class="form-select" onchange="location = this.value;">
            <option value="">เลือกรายวิชา</option>
            <?php $query = "SELECT * FROM course ";
            $sql = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($sql)) {
            ?>
              <option value="?course_id=<?php echo $row["course_id"]; ?> "><?php echo $row["course_name"]; ?></option>
            <?php }
            $course_id = $_GET['course_id'] ?>
          </select>
          <input type="hidden" class="form-control" placeholder="รหัสวิชา" name="editId" value="<?php echo $course_id ?>" />
          <input type="text" class="form-control" placeholder="รหัสวิชา" name="editcode" />
          <input type="text" class="form-control" placeholder="ชื่อวิชา" name="editName" />
          <input type="text" class="form-control" placeholder="ชื่อวิชา(Eng)" name="editNameeng" />
          <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnEdit">แก้ไขข้อมูล</button>
        </div>

        <table id="user_data" style='width:100%;' class="table table-hover ">
          <thead>
            <tr>
              <th style='width:15%;'>รหัสวิชา</th>
              <th style='width:35%;'>ชื่อวิชา</th>
              <th style='width:25%;'>ชื่อวิชา(Eng)</th>
              <th style='width:15%;'></th>
            </tr>
          </thead>
          <tbody>

            <?php

            $query = "SELECT * FROM course ";
            $sql = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($sql)) {
              $course_id = $row['course_id'];
              $course_code = $row['course_code'];
              $course_name = $row['course_name'];
              $course_engname = $row['course_engname'];
            ?>
              <tr id="<?php echo $course_code; ?>" class="edit_tr">
                <td class="edit_td">
                  <span id="id_<?php echo $course_code; ?>" class="text"><?php echo $course_code; ?></span>
                  <!-- <input type="text" value="<?php echo $course_code; ?>" class="editbox" id="id_input_<?php echo $course_code; ?>" name="id_input" /> -->
                </td>
                <td class="edit_td">
                  <span id="name_<?php echo $course_code; ?>" class="text"><?php echo $course_name; ?></span>
                  <!-- <input type="text" value="<?php echo $course_name; ?>" class="editbox" id="name_input_<?php echo $course_code; ?>" name="name_input"/&gt; </td> -->

                <td class="edit_td">
                  <span id="year_<?php echo $course_code; ?>" class="text"><?php echo $course_engname; ?></span>
                  <!-- <input type="text" value="<?php echo $course_engname; ?>" class="editbox" id="year_input_<?php echo $course_code; ?>" name="year_input"/> -->
                </td>
                <td>
                  <button data-id="<?php echo $course_id ?>" value="<?php echo $course_id ?>" class="btn btn-danger delete" name="btnDelete"><i class='bx bx-trash'></i></button>
                </td>
              </tr>
            <?php
            }
            ?>
      </form>
      </tbody>
      </table>
    </div>
  </div>
</body>

</html>