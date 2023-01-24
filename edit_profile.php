<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</head>

<body>
    <?php
    require('./navbar.php');
    require('./connect_program.php');
    ?>
    <div class="container">
        <div class="box">
            <h5>Edit Profile</h5>
            <hr>
            <div class="col g-3">
                <select class="form-select" onchange="location = this.value" aria-label="Default select example">
                    <option selected>เลือกผู้ใช้งาน</option>
                    <option value="?role=1">Advisor</option>
                    <option value="?role=2">Student</option>
                </select>
            </div>
            <?php @$role = $_GET['role'];
            if ($role == '1') {
                @$table = 'teacher';
            } else if ($role == '2') {
                @$table = 'student';
            }
            if(isset($table)){
            @$show = mysqli_query($connect, "SELECT * FROM $table");
            if (mysqli_num_rows($show) <= 5) {
                if (isset($role)) { ?>
                    <form method="POST" action="edit_profile_sql.php" class="row g-3">
                        <div class="row g-3">
                            <div class="col">
                                <input type="text" class="form-control" name="txtFname" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="txtLname" placeholder="Last name" aria-label="Last name">
                            </div>
                        </div>
                        <?php if ($role == '1') { ?>
                            <div class="row g-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="txtAdid" placeholder="Advisor ID">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="txtFaculty" placeholder="Faculty">
                                </div>
                            </div>
                        <?php } else if ($role == '2') { ?>
                            <div class="row g-3">
                                <div class="col">
                                    <input type="text" class="form-control" name="txtStuid" placeholder="Student ID">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="txtFaculty" placeholder="Faculty">
                                </div>
                            </div>
                            <div class="col-12">
                                <select class="form-select" name="selPro" aria-label="Default select example">
                                    <option selected>เลือกหลักสูตร</option>
                                    <?php $program = mysqli_query($connect, "SELECT * FROM program ");
                                    while ($row = mysqli_fetch_array($program)) { ?>
                                        <option value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php
                        } ?>
                        <button type="submit" class="btn btn-outline-primary" name="btnSubmit" value="<?php echo $role ?> ">Submit</button>
                    </form>
                <?php
                }
            } else {
                while ($row = mysqli_fetch_array($show)){ ?>
                <form method="POST" action="edit_profile_sql.php" class="row g-3">
                    <div class="row g-3">
                        <div class="col">
                            <input type="text" class="form-control" name="txtFname" value="<?php echo $row['fname'] ?>" aria-label="First name">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="txtLname" value="<?php echo $row['lname'] ?>" aria-label="Last name">
                        </div>
                    </div>
                    <?php if ($role == '1') { ?>
                        <div class="row g-3">
                            <div class="col">
                                <input type="text" class="form-control" name="txtAdid" value="<?php echo $row['teacher_id'] ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="txtFaculty" value="<?php echo $row['type'] ?>">
                            </div>
                        </div>
                    <?php } else if ($role == '2') { ?>
                        <div class="row g-3">
                            <div class="col">
                                <input type="text" class="form-control" name="txtStuid" value="<?php echo $row['student_id'] ?>">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="txtFaculty" value="<?php echo $row['type'] ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" name="txtProgram" value="<?php echo $row['program_id'] ?>" disabled >
                        </div>
                    <?php
                    } ?>
                    <button type="submit" class="btn btn-outline-primary" name="btnEdit" value="<?php echo $role ?> ">Edit Profile</button>
                    <button type="submit" class="btn btn-outline-danger" name="btnDelete" value="<?php echo $role ?> ">Delete Profile</button>
                </form>
            <?php }}} ?>
        </div>
    </div>

</body>

</html>