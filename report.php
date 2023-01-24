<?php

// header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
// header("Content-Disposition: attachment; filename=abc.xls");  //File name extension was wrong
// header("Expires: 0");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// header("Cache-Control: private", false);

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<body>
    <!-- หัวตาราง -->
    <?php

    require('./connect_program.php');
    $pointer = "305273";
    $table = "SELECT * FROM clo WHERE course_id = '$pointer'ORDER BY clo.id_clo ASC";
    $table2 = "SELECT * FROM assignment WHERE course_id = '$pointer'";
    $sub_table = "course_id";
    $insertData = "---";
    $show = "";
    $table_head_id = "id_clo";
    $table_head_detail = "CLO";
    $table_body_id = "assignment_number";
    $table_body_details = "assignment_name";
    $sql_table = mysqli_query($connect, $table);
    $count = 0;
    while ($row = mysqli_fetch_array($sql_table)) {
        $count = $count + 1;
    } ?>
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
    <table style='width:50%;' class="table table-hover ">
        <tr>
            <!-- หัวตาราง -->
            <?php
            $sql_table = mysqli_query($connect, $table);
            $count = 0;
            while ($row = mysqli_fetch_array($sql_table)) {
                $count = $count + 1;
            } ?>
            <tr >
                <th rowspan="2"></th>
                <th colspan="<?php echo $count ?>"><?php echo $table_head_detail ?></th>
            </tr>
            <!-- <th rowspan="2" > </th> -->
            <?php
            $sql_table = mysqli_query($connect, $table);
            while ($row = mysqli_fetch_array($sql_table)) {

                echo "<th >" . $row[$table_head_id] . "</th>";
            };
            ?>
        </tr>
        <?php
        $sql_table2 = mysqli_query($connect, $table2);
        while ($row = mysqli_fetch_array($sql_table2)) {
            echo //ส่วนในตาราง
            '<tr style="width: 200px;">
                          <td ">' . $show . @$row[$table_body_id] . " " . $row[$table_body_details] . '</td>';
            for ($i = 1; $i <= $count; $i++) {
                echo '<td ></td>';
            }
            '</tr>
                        ';
        }

        ?>
    </table>
</body>

</html>