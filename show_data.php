<?php
function showData_plo($pointer)
{
    $table = "SELECT `plo`.`plo_name`,`plo`.`plo_code`,`plo`.`plo_id`,`plo`.`plo_engname`  FROM `program_plo` 
    LEFT JOIN  `plo`  
    ON   `plo`.plo_id = `program_plo`.plo_id 
    Where `program_plo`.`program_id`  ='$pointer' ";
    $table_header = "PLO";
    $table_body_id = "plo_code";
    $table_id = "plo_id";
    $table_body_details = "plo_name";
    $table_body_details_eng = "plo_engname";
    $insertData = "insertData_plo.php";
    showData($table, $table_header, $table_body_id, $table_body_details, $table_id, $insertData,$table_body_details_eng);
}
function showData_clo($pointer)
{
    $table = "SELECT `clo`.`clo_name`,`clo`.`clo_code`,`clo`.`clo_id`,`clo`.`clo_engname`  FROM `course_clo` 
    LEFT JOIN  `clo`  
    ON   `clo`.clo_id = `course_clo`.clo_id 
    Where `course_clo`.`year_str`  ='$pointer' ";
    $table_header = "CLO";
    $table_body_id = "clo_code";
    $table_id = "clo_id";
    $table_body_details_eng = "clo_engname";
    $table_body_details = "clo_name";
    $insertData = "insertData_clo.php";
    showData($table, $table_header, $table_body_id, $table_body_details, $table_id, $insertData,$table_body_details_eng);
}
function showData($table, $table_header, $table_body_id, $table_body_details, $table_id, $insertData,$table_body_details_eng)
{
    require('./connect_program.php') ?>
    <style>
        table,
        th {
            text-align: center;
        }

        td {
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }
    </style>
    <table style='width:100%;' class="table table-hover">
        <thead class="table-light">
            <!-- หัวตาราง -->
            <th style="width: 100px;"><?php echo $table_header ?></th>
            <th style="text-align: left;width: 500px"> รายละเอียด </th>
            <th style="text-align: left;width: 500px"> รายละเอียด(Eng) </th>
            <th></th>
        </thead>
        <form action='<?php echo $insertData ?>' method="POST">
            <?php
            $sql_table = mysqli_query($connect, $table);

            while ($row = mysqli_fetch_array($sql_table)) {
                //ส่วนในตาราง
            ?>
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo $row[$table_body_id] ?>
                        </td>
                        <td >
                            <?php echo $row[$table_body_details]  ?>
                        </td>
                        <td>
                            <?php echo $row[$table_body_details_eng]  ?>
                        </td>
                        <td>
                            <button  value="<?php echo $row[$table_id] ?>" class="btn btn-danger delete" name="btnDelete"><i class='bx bx-trash'></i></button>
                        </td>
                    </tr>
                </tbody>


            <?php }

            ?>
        </form>
    </table>
<?php }
?>