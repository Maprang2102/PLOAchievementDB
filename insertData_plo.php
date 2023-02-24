<?php
require('./connect_program.php');
if (isset($_POST["btnAdd"])) {
    $program_id = @$_POST['program_id'];
    $plo_code = @$_POST['plo_code'];
    $plo_name = @$_POST["plo_name"];

    $sql = "INSERT INTO plo(plo_name,plo_code) VALUES('$plo_name','$plo_code')";

    $result = mysqli_query($connect, $sql);

    $max = "SELECT MAX(plo_id) as 'plo_id' FROM plo";
    $query = mysqli_fetch_array(mysqli_query($connect, $max));
    $plo_id = $query['plo_id'];
    $program_plo = "INSERT INTO program_plo(program_id,plo_id) VALUES('$program_id','$plo_id')";
    $result1 = mysqli_query($connect, $program_plo);
    if ($result1) {
        header("location: ./plopage.php?program_id=".$program_id);
    } else {
        echo "Failed";
    }
}
if (isset($_POST["btnEdit"])) {
    $program_id = @$_POST['program_id'];
    $id = $_POST["Ploid"];
    $plo_name = $_POST["editName"];
    $plo_engname = $_POST["editNameeng"];
    // echo $id;
    $edit = "UPDATE plo SET plo_name='$plo_name',plo_engname='$plo_engname' WHERE plo_id='$id'";
    $result = mysqli_query($connect, $edit);
    if ($result) {
        header("location: ./plopage.php?program_id=".$program_id);
    }
    else{
        echo "fail";
    }
}
if (isset($_POST["btnDelete"])) {
    $program_id = @$_POST['program_id'];
    $id = $_POST["btnDelete"];
    echo $id ;
    $del = "DELETE FROM plo WHERE plo_id = '$id'";
    if (mysqli_query($connect, $del)) {
        header("location: ./plopage.php?program_id=".$program_id);
    }
}
