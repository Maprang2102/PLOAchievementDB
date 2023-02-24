<?php 
require('./connect_program.php');
$sql = "SELECT * FROM program ";
$query = mysqli_query($connect, $sql);
$program_id = $_GET['program_id'];
?>
<select class="form-select">
    <?php 
    while ($row = mysqli_fetch_array($query)) { ?>
        <option <?php if($row["program_id"] === $program_id) echo "selected"?>><?php echo $row["program_name"]; ?></option>
    <?php }
    ?>
</select>