<?php
function accordion_table_assignment()
{
    $pointer = @$_GET['course_id'];
    $table = "SELECT * FROM clo WHERE course_id = '$pointer'ORDER BY clo.id_clo ASC";
    $table2 = "SELECT * FROM assignment WHERE course_id = '$pointer'";
    $sub_table = "course_id";
    $insertData = "---";
    $show = "";
    $table_head_id = "id_clo";
    $table_head_detail = "CLO";
    $table_body_id = "assignment_number";
    $table_body_details = "assignment_name";
    table($pointer, $table, $table2, $sub_table, $insertData, $show, $table_head_id, $table_head_detail, $table_body_id, $table_body_details);
}
function accordion_table()
{
    require('./connect_program.php');
    $pointer = @$_GET['course'];
    $year = @$_GET['year'];
    @$program_id = $_GET['program_id'];
    @$course = $_GET['course'];
    @$section = $_GET['section'];
    @$semester = $_GET['semester'];
    @$year = $_GET['year'];
    $i = 0;
    $count_txt = 0;
    $count_loop = 1;
    if (isset($year)) {
?><br>
        <div class="accordion" id="accordionExample">
            <?php $assign = "SELECT * FROM assignment WHERE course_id='$pointer'";
            $sql_table1 = mysqli_query($connect, $assign);

            while ($assign1 = mysqli_fetch_array($sql_table1)) {
                $assignment_id = $assign1['assign_id'];
                if ($i == 0) {

            ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <h5><?php echo $assign1['assign_name']; ?>
                                    <input type="hidden" name="assign_id" value="<?php echo $assign1['assign_id'] ?>">
                                    <?php echo "[".$assign1['full_score']."]" ?>
                                </h5>
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="link_clo_assign.php" method="POST">
                                    <table style="width: 100%;" class="table table-hover ">
                                        <thead>
                                            <?php $clo = "SELECT `clo`.`clo_name`,`clo`.`clo_id`,`clo`.`clo_code`  
                                    FROM `course_clo` LEFT JOIN  `clo` ON `clo`.clo_id = `course_clo`.clo_id 
                                    Where `course_clo`.`course_id`  = '$pointer' AND `course_clo`.`year_str`='$year' ";
                                            $clo_table = mysqli_query($connect, $clo);
                                            $count_clo = mysqli_num_rows($clo_table);
                                            ?>
                                            <tr style="background-color:#ddd">
                                                <th rowspan="2"></th>
                                                <th colspan="<?php echo $count_clo ?>">CLO</th>
                                                <th rowspan="2"></th>
                                            </tr>
                                            <tr style="background-color:#ddd">
                                                <?php while ($clo1 = mysqli_fetch_array($clo_table)) {  ?>
                                                    <th><?php echo $clo1['clo_code'] ?></th><?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php $subassign = "SELECT * FROM sub_assignment WHERE assign_id='$assignment_id'";
                                                $sql_table = mysqli_query($connect, $subassign);
                                                while ($subassign1 = mysqli_fetch_array($sql_table)) { ?>
                                                    <td style="text-align:left;">
                                                        <?php echo $subassign1['topic'] ?>
                                                    </td>
                                                    <?php $clo_table1 = mysqli_query($connect, $clo);
                                                    while ($clo2 = mysqli_fetch_array($clo_table1)) {
                                                        $asssub = $subassign1['sub_assign_id'];
                                                        $cloclo = $clo2['clo_id'];
                                                        $weight_clo_assign = "";
                                                        $clo_assign = mysqli_query($connect, "SELECT * FROM clo_assignment WHERE assign_id='$assignment_id' AND clo_id='$cloclo' AND sub_assign_id='$asssub'");
                                                        while ($cass = mysqli_fetch_array($clo_assign)) {
                                                            $weight_clo_assign = $cass['weight'];
                                                        }
                                                    ?>
                                                        <td style="text-align: center;">
                                                            <input type="text" name="txtweight<?php echo  $count_txt ?>" value="<?php echo $weight_clo_assign ?>" style="width: 35px;margin-left:5px">
                                                            <input type="hidden" name="weight_old<?php echo  $count_txt ?>" value="<?php echo $weight_clo_assign ?>">
                                                            <input type="hidden" name="clo_id<?php echo  $count_txt ?>" value="<?php echo  $clo2['clo_id'] ?>">
                                                            <input type="hidden" name="sub_assign_id<?php echo  $count_txt ?>" value="<?php echo  $subassign1['sub_assign_id'] ?>">
                                                            <input type="hidden" name="assign_id<?php echo  $count_txt ?>" value="<?php echo  $subassign1['assign_id'] ?>">
                                                            <input type="hidden" name="count_txt" value="<?php echo  $count_txt ?>">
                                                            <input type="hidden" class="form-control" placeholder="Year" name="clo_year" value="<?php echo $year  ?> ">
                                                            <input type="hidden" class="form-control" placeholder="Semester" name="semester" value="<?php echo $semester ?>">
                                                            <input type="hidden" class="form-control" placeholder="Section" name="section" value="<?php echo $section  ?>">
                                                            <input type="hidden" class="form-control" name="program_id" value="<?php echo $program_id ?>">
                                                            <input type="hidden" class="form-control" name="course_id" value="<?php echo $course ?> ">
                                                        </td>

                                                    <?php $weight_clo_assign = "";
                                                        $count_txt++;
                                                    }
                                                    ?>
                                                    <td>
                                                        <!-- <button type="button" class="btn edit"><i class='bx bx-edit'></i></button> -->
                                                        <!-- <button type="submit" class="btn edit check" name="btnSubmit"><i class='bx bx-check'></i></i></button> -->
                                                        <button type="button" class="btn btn-outline-danger" name="btnDelete" value="<?php echo $subassign1['sub_assign_id'] ?>"><i class='bx bxs-trash'></i></button>
                                                        <!-- <button type="button" class="btn edit cancel"><i class='bx bx-x'></i></button> -->
                                                    </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                    <div style="justify-content: flex-end; display: flex;">
                                        <button type="submit" class="btn btn-outline-success" name="btnSubmit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
                } else { ?>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="heading<?php echo $assign1['assign_id'] ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $assign1['assign_id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $assign1['assign_id'] ?>">
                                <h5><?php echo $assign1['assign_name']. " [".$assign1['full_score']."]" ?></h5>
                                
                            </button>
                        </h3>
                        <div id="collapse<?php echo $assign1['assign_id'] ?>" class="accordion-collapse collapse " aria-labelledby="heading<?php echo $assign1['assign_id'] ?>" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <form action="link_clo_assign.php" method="POST">
                                    <table style="width: 100%;" class="table table-hover ">
                                        <thead>
                                            <?php $clo = "SELECT `clo`.`clo_name`,`clo`.`clo_id`,`clo`.`clo_code`  
                                    FROM `course_clo` LEFT JOIN  `clo` ON `clo`.clo_id = `course_clo`.clo_id 
                                    Where `course_clo`.`course_id`  = '$pointer' AND `course_clo`.`year_str`='$year' ";
                                            $clo_table = mysqli_query($connect, $clo);
                                            $count_clo = mysqli_num_rows($clo_table);
                                            ?>
                                            <tr style="background-color:#ddd">
                                                <th rowspan="2"></th>
                                                <th colspan="<?php echo $count_clo ?>">CLO</th>
                                                <th rowspan="2"></th>
                                            </tr>
                                            <tr style="background-color:#ddd">
                                                <?php while ($clo1 = mysqli_fetch_array($clo_table)) {  ?>
                                                    <th><?php echo $clo1['clo_code'] ?></th><?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php $subassign = "SELECT * FROM sub_assignment WHERE assign_id='$assignment_id'";
                                                $sql_table = mysqli_query($connect, $subassign);
                                                while ($subassign1 = mysqli_fetch_array($sql_table)) { ?>
                                                    <td style="text-align:left;">
                                                        <?php echo $subassign1['topic'] ?>
                                                    </td>
                                                    <?php $clo_table1 = mysqli_query($connect, $clo);
                                                    while ($clo2 = mysqli_fetch_array($clo_table1)) {
                                                        $asssub = $subassign1['sub_assign_id'];
                                                        $cloclo = $clo2['clo_id'];
                                                        $weight_clo_assign = "";
                                                        $clo_assign = mysqli_query($connect, "SELECT * FROM clo_assignment WHERE assign_id='$assignment_id' AND clo_id='$cloclo' AND sub_assign_id='$asssub'");
                                                        while ($cass = mysqli_fetch_array($clo_assign)) {
                                                            $weight_clo_assign = $cass['weight'];
                                                        }
                                                    ?>
                                                        <td style="text-align: center;">
                                                            <input type="text" name="txtweight<?php echo  $count_txt ?>" value="<?php echo $weight_clo_assign ?>" style="width: 35px;margin-left:5px">
                                                            <input type="hidden" name="weight_old<?php echo  $count_txt ?>" value="<?php echo $weight_clo_assign ?>">
                                                            <input type="hidden" name="clo_id<?php echo  $count_txt ?>" value="<?php echo  $clo2['clo_id'] ?>">
                                                            <input type="hidden" name="sub_assign_id<?php echo  $count_txt ?>" value="<?php echo  $subassign1['sub_assign_id'] ?>">
                                                            <input type="hidden" name="assign_id<?php echo  $count_txt ?>" value="<?php echo  $subassign1['assign_id'] ?>">
                                                            <input type="hidden" name="count_txt" value="<?php echo  $count_txt ?>">
                                                            <input type="hidden" class="form-control" placeholder="Year" name="clo_year" value="<?php echo $year  ?> ">
                                                            <input type="hidden" class="form-control" placeholder="Semester" name="semester" value="<?php echo $semester ?>">
                                                            <input type="hidden" class="form-control" placeholder="Section" name="section" value="<?php echo $section  ?>">
                                                            <input type="hidden" class="form-control" name="program_id" value="<?php echo $program_id ?>">
                                                            <input type="hidden" class="form-control" name="course_id" value="<?php echo $course ?> ">
                                                        </td>

                                                    <?php $weight_clo_assign = "";
                                                        $count_txt++;
                                                    }
                                                    ?>
                                                    <td>
                                                        <!-- <button type="button" class="btn edit"><i class='bx bx-edit'></i></button> -->
                                                        <button type="button" class="btn btn-outline-danger" name="btnDelete" value="<?php echo $subassign1['sub_assign_id'] ?>"><i class='bx bxs-trash'></i></button>
                                                        <!-- <button type="button" class="btn edit cancel"><i class='bx bx-x'></i></button> -->
                                                    </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                    <div style="justify-content: flex-end; display: flex;">
                                        <button type="submit" class="btn btn-outline-success" name="btnSubmit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        <?php }
                $i++;
            }
        } ?>
        </div>
        <style>
            table,
            th,
            td {
                border: 0.1px solid #ccc;
                text-align: center;
            }

            [class*="edit"] {
                border: none;
                font-size: 20px;
            }

            [class*="check"] {
                color: #294;
                font-size: 22px;
            }

            [class*="cancel"] {
                color: #811;
                font-size: 22px;
            }

            [class*="trash"] {
                color: #5e5e5e;
            }

            [class*="edit"]:hover {
                background-color: #ccc;
            }
        </style>
    <?php
}
    ?>