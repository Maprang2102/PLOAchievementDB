<?php
function table_plo()
{
    $pointer = @$_GET['program_id'];
    $table = "SELECT `plo`.`plo_id`,`plo`.`plo_name`,`plo`.`plo_code`  FROM `program_plo` 
    LEFT JOIN  `plo`  
    ON   `plo`.plo_id = `program_plo`.plo_id 
    Where `program_plo`.`program_id`  ='$pointer' ";

    $table2 = "SELECT `course`.`course_name`,`course`.`course_id`,`course`.`course_code`  FROM `program_course` 
    LEFT JOIN  `course`  
    ON   `course`.course_id = `program_course`.course_id 
    Where `program_course`.`program_id`  ='$pointer' ";

    $sub_table = "program_id";
    $insertData = "---";
    $show = "";
    $table_head_id = "plo_id";
    $table_head_detail = "PLO";
    $table_body_id = "course_id";
    $table_body_details = "course_name";
    
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
            background: #eee;
        }
    </style>
    <br>
    <form method="post" action="link_plo_course.php">
        <table style='width:100%;' class="table table-hover ">
            <thead>
                <!-- หัวตาราง -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                $count = 0;
                $count_txt = 0;
                while ($row = mysqli_fetch_array($sql_table)) {
                    $count = $count + 1;
                } ?>
                <tr style="background-color:#ddd">
                    <th rowspan="2"></th>
                    <th colspan="<?php echo $count ?>"><?php echo $table_head_detail ?></th>
                    <th rowspan="2">Total</th>
                </tr>
                <!-- <th rowspan="2" > </th> -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                while ($row = mysqli_fetch_array($sql_table)) {

                    echo "<th style='background-color:#ddd'>&nbsp;" . $row['plo_code'] . "&nbsp;</th>";
                };
                ?>
                
            </thead>
            <?php
            $sql_table2 = mysqli_query($connect, $table2);
            while ($row = mysqli_fetch_array($sql_table2)) {
                //ส่วนในตาราง 
            ?>
                <tbody>
                    <td style="width: 300px;"><?php echo $show . $row['course_code'] . " " . $row['course_name'] ?> </td>
                    <?php
                    $course_plo = mysqli_query($connect, "SELECT * FROM course_plo ");
                    $course_weight = mysqli_num_rows($course_plo);
                    $total_weight = 0;
                    if ($course_weight <= 0) {
                        $sql_table = mysqli_query($connect, $table);
                        while ($row1 = mysqli_fetch_array($sql_table)) {
                            $count_txt = $count_txt + 1; ?>
                            <td style="text-align: center;">
                                <input type="text" name="txtweight<?php echo  $count_txt ?>" style="width: 35px;margin-left:5px">
                                <input type="hidden" name="plo_id<?php echo  $count_txt ?>" value="<?php echo  $row1['plo_id'] ?>">
                                <input type="hidden" name="course_id<?php echo  $count_txt ?>" value="<?php echo  $row['course_id'] ?>">
                                <input type="hidden" name="count_txt" value="<?php echo  $count_txt ?>">
                                <input type="hidden" name="program_id" value="<?php echo  $pointer ?>">
                            </td>
                        <?php }
                    } else {
                        $sql_table = mysqli_query($connect, $table);
                        while ($row1 = mysqli_fetch_array($sql_table)) {
                            $course_id = $row['course_id'];
                            $plo_id = $row1['plo_id'];
                            $course_plo = mysqli_query($connect, "SELECT * FROM course_plo WHERE course_id ='$course_id' AND plo_id ='$plo_id'");
                            while ($weight = mysqli_fetch_array($course_plo)) { 
                            $weight_course_plo = $weight['weight'];
                            $total_weight = $weight['weight'] + $total_weight;
                            // echo $weight['weight']."<br>";
                            }
                            $count_txt = $count_txt + 1; ?>
                            <td style="text-align: center;">
                                <input type="text" name="txtweight<?php echo  $count_txt ?>" value="<?php echo $weight_course_plo  ?>" style="width: 35px;margin-left:5px">
                                <input type="hidden" name="weight_old<?php echo  $count_txt ?>" value="<?php echo $weight_course_plo;  ?>">
                                <input type="hidden" name="plo_id<?php echo  $count_txt ?>" value="<?php echo  $row1['plo_id'] ?>">
                                <input type="hidden" name="course_id<?php echo  $count_txt ?>" value="<?php echo  $row['course_id'] ?>">
                                <input type="hidden" name="count_txt" value="<?php echo  $count_txt ?>">
                                <input type="hidden" name="program_id" value="<?php echo  $pointer ?>">
                            </td>
                            
                    <?php $weight_course_plo="";
                        }
                    } ?>
                    <td style="text-align: center;"><?php echo $total_weight;
                    $total_weight = 0 ; ?></td>
                </tbody>

            <?php } ?>
        </table>
        <?php 
        if ($course_weight <= 0) { ?>
            <button class="btn btn-outline-primary" type="submit" name="btnSubmit">Add</button>
        <?php 
    } else { ?>
            <button class="btn btn-outline-primary" type="submit" name="btnEdit">Edit</button>
        <?php 
    } ?>
    </form>
<?php
}
function table_clo()
{
    $pointer_program = @$_GET['program_id'];
    $pointer = @$_GET['course'];
    $table = "SELECT `plo`.`plo_name`,`plo`.`plo_code`,`plo`.`plo_id`  FROM `program_plo` 
    LEFT JOIN  `plo`  
    ON   `plo`.plo_id = `program_plo`.plo_id 
    Where `program_plo`.`program_id`  ='$pointer_program' ";
    $table2 = "SELECT `clo`.`clo_name`,`clo`.`clo_code`,`clo`.`clo_id`  FROM `course_clo` 
    LEFT JOIN  `clo`  
    ON   `clo`.clo_id = `course_clo`.clo_id 
    Where `course_clo`.`course_id`  ='$pointer' ";
    $table_head_id = "plo_code";
    $table_head_detail = "PLO";
    $table_body_id = "CLO";
    $table_body_details = "clo_code";
    $year = $_GET["year"];
    $semester = $_GET["semester"];
    $course = $_GET["course"];
    $section = $_GET["section"];
    $table_plo_clo = "SELECT DISTINCT * FROM plo_clo WHERE year_str='$year' AND semester_id='$semester' AND course_id='$course' AND section_id='$section' ORDER BY `plo_id`,`clo_id` ASC";
    $count_clo = 0;
    $count_plo = 0;
    $count_radio = 0;
    $count_weight = 0;
    $radio_value = '';
    $check = 0;
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
            background: #eee;
        }
    </style>
    <div style="display:flex;justify-content: flex-end;">
        <button class="btn btn-outline-primary" type="submit" name="edit_table" value="Edit Table" style="margin-left:16px;" onclick=" undisable() ">Edit Table</button>
    </div>
    <br>
    <form method="post" action="post_table.php">
        <table id='tbclo' style='width:100%;' class="table table-hover ">
            <thead>
                <!-- หัวตาราง -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                $count = 0;
                while ($row = mysqli_fetch_array($sql_table)) {
                    $count = $count + 1;
                }
                echo '<script type="text/javascript">';
                echo "var count = '$count';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
                echo '</script>';
                ?>
                <tr style="background-color:#ddd">
                    <th rowspan="2"></th>
                    <th colspan="<?php echo $count ?>"><?php echo $table_head_detail ?></th>
                    <th rowspan="2">Weight</th>
                </tr>
                <!-- <th rowspan="2" > </th> -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                while ($plo = mysqli_fetch_array($sql_table)) { ?>
                    <th style='background-color:#ddd'>&nbsp;<?php echo $plo[$table_head_id] ?> &nbsp;</th>
                <?php }
                ?>
            </thead>
            <?php

            // $j = 0;
            $sql_table2 = mysqli_query($connect, $table2);
            while ($clo = mysqli_fetch_array($sql_table2)) {
                $count_clo = $count_clo + 1;
                //ส่วนในตาราง 
                $plo_clo = mysqli_query($connect, $table_plo_clo);
                $plo_clo_results = mysqli_num_rows($plo_clo);
                while ($show_pclo = mysqli_fetch_array($plo_clo)) {
                    $show_clo[] = $show_pclo['clo_id'];
                    $show_plo[] = $show_pclo['plo_id'];
                }
                // print_r($show_clo);
            ?>

                <tbody>
                    <tr>
                        <td>
                            <?php echo "CLO " . $clo[$table_body_details] ?>
                        </td>
                        <?php


                        // if ($plo_clo_results <= 0) {
                        $sql_table = mysqli_query($connect, $table);
                        while ($plo = mysqli_fetch_array($sql_table)) {
                            // echo "clo :".$show_clo[$count_radio]."-".$clo['clo_id']." plo :".$show_plo[$count_radio]."-".$plo['plo_id']."<br>";
                            if (($show_clo[$count_radio] == $clo['clo_id']) && ($show_plo[$count_radio] == $plo['plo_id'])) {
                                $radio_value = 'yes';
                                $clo_id = $clo['clo_id'];
                            }
                            $count_plo = $count_plo + 1;
                        ?>
                            <td style="text-align:center">
                                <input type="radio" name="rdo<?php echo $clo['clo_id'] ?>" id="rdoTestClo<?php echo $count_clo . $count_plo ?>" value="<?php echo $plo['plo_id'] ?>" <?php if (isset($radio_value) && $radio_value ==  'yes') : ?>checked='checked' <?php endif; ?>>
                                <input type="hidden" name="course_id" value="<?php echo $course ?>">
                                <input type="hidden" name="program_id" value="<?php echo $pointer_program ?>">
                                <input type="hidden" name="plo_id" value="<?php echo $plo['plo_id'] ?>">
                                <input type="hidden" name="count" value="<?php echo $count_clo ?>">
                                <input type="hidden" name="year" value="<?php echo $_GET['year']  ?> ">
                                <input type="hidden" name="semester" value="<?php echo $_GET['semester']  ?>">
                                <input type="hidden" name="section" value="<?php echo $_GET['section']  ?>">
                            </td>

                        <?php
                        $clo_id = $clo['clo_id'];
                            // echo $radio_value;
                            // echo $clo_id;

                            echo '<script type="text/javascript">';
                            echo "var count_clo = '$count_clo';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
                            echo "var count_plo = '$count_plo';";
                            echo '</script>';
                            $radio_value = 'no';
                        }
                        // echo $count_weight ;
                        $count_plo = 0;
                        ?><td style="text-align:center;">
                        <?php
                        $table_plo_clo = "SELECT * FROM plo_clo WHERE year_str='$year' AND semester_id='$semester' AND course_id='$course' AND section_id='$section' AND clo_id='$clo_id'";
                        $plo_clo = mysqli_query($connect, $table_plo_clo);
                        while ($show_pclo1 = mysqli_fetch_array($plo_clo)) {
                        ?>
                        
                        <input type="text" name="txtweight<?php echo $count_weight  ?>" value="<?php echo $show_pclo1['weight'] ?>" style="width: 35px;margin-left:5px">
                        
                        <?php $check=1; } 
                        if($check==0){ ?>
                            <input type="text" name="txtweight<?php echo $count_weight  ?>" style="width: 35px;margin-left:5px">
                        <?php }
                        $count_weight++;
                        // $clo_id = 0;
                        $check = 0; ?></td>
                    </tr>
                </tbody>


            <?php $count_radio++;
            } ?>
        </table>
        <button class="btn btn-outline-primary" type="submit" name="btnSubmit" onClick="disable()" value="Submit">Submit</button>
    </form>
    <script>
        function disable() {
            for (var i = 1; i <= count_clo; i++) {
                for (var j = 1; j <= count_plo; j++) {
                    document.getElementById("clo" + i + j).disabled = true;
                }
            }
            // alert("clo" + i + j);
            // alert(count_clo);
            // alert(count_plo);
        }

        function undisable() {
            for (var i = 1; i <= count_row; i++) {
                for (var j = 1; j <= count_col; j++) {
                    document.getElementById("clo" + i + j).disabled = false;
                }
            }
        }
    </script>

<?php
    // table1($pointer, $table, $table2, $sub_table, $insertData, $show, $table_head_id, $table_head_detail, $table_body_id, $table_body_details,);
}
function table_assignment()
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

function table($pointer, $table, $table2, $sub_table, $insertData, $show, $table_head_id, $table_head_detail, $table_body_id, $table_body_details)
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
            background: #eee;
        }
    </style>
    <br>
    <from>
        <table style='width:100%;' class="table table-hover ">
            <thead>
                <!-- หัวตาราง -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                $count = 0;
                while ($row = mysqli_fetch_array($sql_table)) {
                    $count = $count + 1;
                } ?>
                <tr style="background-color:#ddd">
                    <th rowspan="2"></th>
                    <th colspan="<?php echo $count ?>"><?php echo $table_head_detail ?></th>
                </tr>
                <!-- <th rowspan="2" > </th> -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                while ($row = mysqli_fetch_array($sql_table)) {

                    echo "<th style='background-color:#ddd'>&nbsp;" . $row[$table_head_id] . "&nbsp;</th>";
                };
                ?>
            </thead>
            <?php
            $sql_table2 = mysqli_query($connect, $table2);
            while ($row = mysqli_fetch_array($sql_table2)) {
                echo //ส่วนในตาราง
                '<tbody>
                          <td style="width: 300px;">' . $show . $row[$table_body_id] . " " . $row[$table_body_details] . '</td>';
                while ($row1 = mysqli_fetch_array($sql_table)) {
                    echo '<td style="text-align: center;">
                    <input type="text" name="txtweight" style="width: 35px;margin-left:5px">
                    <input type="hidden" name="plo_id" value="' . $row1['plo_id'] . '">
                    <input type="hidden" name="course_id" value="' . $row1['plo_id'] . '">
                    </td>';
                }
                '</tbody>
                        ';
            }

            ?>
        </table>
        <button class="btn btn-outline-primary" type="submit">Add</button>
    </from>
<?php }

function table1($pointer, $table, $table2, $sub_table, $insertData, $show, $table_head_id, $table_head_detail, $table_body_id, $table_body_details,)
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
            background: #eee;
        }
    </style>
    <div style="display:flex;justify-content: flex-end;">
        <!-- <form method="post" style="justify-content: flex-end; display: flex;"> -->
        <!-- <input class="btn btn-outline-primary" type="submit" name="input_clo" value="Add CLO" />
        <input class="btn btn-outline-primary" type="submit" name="import_excel" value="Upload Excel" style="margin-left: 16px;" /> -->
        <button class="btn btn-outline-primary" type="submit" name="edit_table" value="Edit Table" style="margin-left:16px;" onclick=" undisable() ">Edit Table</button>
        <!-- </form> -->
    </div>
    <?php
    if (isset($_POST['input_clo'])) {
        input_CLO();
    }
    if (isset($_POST['import_excel'])) {
        importfile();
    }
    ?>
    <!-- <button class="btn btn-outline-primary" type="submit" name="edit_table" value="Edit Table" style="margin-left:16px;" onclick=" undisable() ">Edit Table</button> -->
    <br>
    <from>
        <table id='tbclo' style='width:100%;' class="table table-hover ">
            <thead>
                <!-- หัวตาราง -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                $count = 0;
                while ($row = mysqli_fetch_array($sql_table)) {
                    $count = $count + 1;
                }
                echo '<script type="text/javascript">';
                echo "var count = '$count';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
                echo '</script>';
                ?>
                <tr style="background-color:#ddd">
                    <th rowspan="2"></th>
                    <th colspan="<?php echo $count ?>"><?php echo $table_head_detail ?></th>
                </tr>
                <!-- <th rowspan="2" > </th> -->
                <?php
                $sql_table = mysqli_query($connect, $table);
                while ($row1 = mysqli_fetch_array($sql_table)) {

                    echo "<th style='background-color:#ddd'>&nbsp;" . $row1[$table_head_id] . "&nbsp;</th>";
                };
                ?>
            </thead>
            <?php
            $col = [2, 4, 6, 8, 15, 3, 5, 1];
            $row = [1, 2, 3, 4, 5, 6, 7, 8];
            $count_row = 0;
            $count_col = 0;
            $j = 0;
            $sql_table2 = mysqli_query($connect, $table2);
            while ($row2 = mysqli_fetch_array($sql_table2)) {
                echo //ส่วนในตาราง
                '<tbody>
                          <td style="width: 300px;">' . $show . @$row2[$table_body_id] . " " . $row2[$table_body_details] . '</td>';
                $count_col = 0;

                $count_row = $count_row + 1;
                for ($i = 1; $i <= $count; $i++) {
                    $count_col = $count_col + 1;
                    // check number to checked 
                    if ($count_row == @$row[$j] && $count_col == @$col[$j]) {
                        $radio_value = 'yes';
                        $j = $j + 1;
                        // echo "check " ;
                        if ($j >= 9) {
                            break;
                        }
                    }
                    echo '<td style="text-align: center;">'; ?>
                    <input type="radio" id="clo<?php echo $count_row . $count_col ?>" name="clo<?php echo $row2[$table_body_details] ?> " value=<?php echo $i ?> style="width: 35px;margin-left:5px" <?php if (isset($radio_value) && $radio_value ==  'yes') : ?>checked='checked' <?php endif; ?>></td>
                <?php
                    // echo $radio_value;
                    echo '<script type="text/javascript">';
                    echo "var count_col = '$count_col';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
                    echo "var count_row = '$count_row';";
                    echo '</script>';
                    $radio_value = 'no';
                }
                '</tbody>
                
                        ';

                ?>
                <script>
                    function disable() {
                        for (var i = 1; i <= count_row; i++) {
                            for (var j = 1; j <= count_col; j++) {
                                document.getElementById("clo" + i + j).disabled = true;
                            }
                        }
                        // alert("clo" + i+j);
                        // alert(count_col);
                        // alert(count_row);
                    }

                    function undisable() {
                        for (var i = 1; i <= count_row; i++) {
                            for (var j = 1; j <= count_col; j++) {
                                document.getElementById("clo" + i + j).disabled = false;
                            }
                        }
                    }
                </script>
            <?php } ?>
        </table>
        <!-- <?php for ($i = 0; $i <= 3; $i++) { ?>
            <input type="radio" id="clo<?php echo $i; ?>" name="rabio" />
        <?php } ?> -->
        <button class="btn btn-outline-primary" type="submit" value="Submit" onClick=" disable() ">Submit</button>
    </from>
<?php } ?>
<script type="text/javascript">
    function test() {
        //alert('test');
        var tRow = document.getElementById('tbclo').getElementsByTagName("tr");
        //console.log(html);
        //alert(tRow.length);

        for (var i = 2; i < tRow.length; i++) {
            //if(tRow[i].id == "name of your id"){
            //do something
            //}
            var col1 = tRow[i].firstElementChild;
            alert(col1.innerHTML);

            var col2 = tRow[i].firstElementChild.nextSibling;
            alert(col2.nodeName);

            var rdo1st = tRow[i].firstElementChild.nextSibling.firstElementChild;
            alert(rdo1st.tagName);
            //.nextSibling

            var rdoValue1st = tRow[i].firstElementChild.nextSibling.firstElementChild.value;
            alert(rdoValue1st);

            break;
        }
    }
</script>