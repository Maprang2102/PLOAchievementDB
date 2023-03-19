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
      <h3>เพิ่ม แก้ไข ลบ หลักสูตร</h3>
      <hr>
      <h5>เพิ่มหลักสูตร</h5>
      <form method="POST" action="edit_program_sql.php">
        <div class="input-group mb-3">
          <input type="hidden" class="form-control" name="txtId" />
          <input type="text" class="form-control" placeholder="ชื่อหลักสูตร" name="txtName" />
          <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnSubmit">เพิ่มข้อมูล</button>
        </div>
      <hr>
      <h5>แก้ไขหลักสูตร</h5>
        <div class="input-group mb-3">
        <select class="form-select" onchange="location = this.value;">
        <option value="">เลือกหลักสูตร</option>
        <?php $query = "SELECT * FROM program ";
          $sql = mysqli_query($connect, $query);
        while ($row = mysqli_fetch_array($sql)) {
        ?>
            <option value="?program_id=<?php echo $row["program_id"]; ?> "><?php echo $row["program_name"]; ?></option>
        <?php } 
        $program_id = $_GET['program_id'] ?>
    </select>
          <input type="hidden" class="form-control" placeholder="ID program" name="editId" value="<?php echo $program_id ?>"/>
          <input type="text" class="form-control" placeholder="ชื่อหลักสูตร" name="editName" />
          <button class="btn btn-outline-primary" type="submit" value="Submit" name="btnEdit">แก้ไขข้อมูล</button>
        </div>

      <table id="user_data" style='width:100%;' class="table table-hover ">
        <thead>
          <tr>
            <!-- <th style='width:15%;'>Program ID</th> -->
            <th style='width:35%;'>หลักสูตร</th>
            <!-- <th style='width:25%;'>Year</th> -->
            <th style='width:15%;'></th>
          </tr>
        </thead>
        <tbody>

          <?php

          $query = "SELECT * FROM program ";
          $sql = mysqli_query($connect, $query);
          while ($row = mysqli_fetch_array($sql)) {
            $program_id = $row['program_id'];
            $program_name = $row['program_name'];
          ?>
            <tr id="<?php echo $program_id; ?>" class="edit_tr">
              <!-- <td class="edit_td">
                <span id="id_<?php echo $program_id; ?>" class="text"><?php echo $program_id; ?></span>
              </td> -->
              <td class="edit_td">
                <span id="name_<?php echo $program_id; ?>" class="text"><?php echo $program_name; ?></span>
              <td>
                <button data-id="<?php echo $program_id ?>" value="<?php echo $program_id ?>" class="btn btn-danger delete" name="btnDelete"><i class='bx bx-trash'></i></button>
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

<!-- <style>
  body {
    /* font-family: Arial, Helvetica, sans-serif; */
    font-size: 14px;
  }

  .editbox {
    display: none
  }

  td {
    padding: 5px;
  }

  .editbox {
    /* font-size: 14px; */
    width: 270px;
    background-color: #fff;
    border: solid 1px #555;
    padding: 4px;
  }

  .edit_tr:hover {
    /* background: url(edit.png) right no-repeat #80C8E5; */
    cursor: pointer;
  }
</style> -->

</html>