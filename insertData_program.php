<?php
require('./connect_program.php');


$program_id = $_POST['program_id'];
$program_name = $_POST["program_name"];
// $university = $_POST["university"];
// $faculty = $_POST["faculty"];
// $branch = $_POST["branch"];
$year = $_POST["year"];

$sql = "INSERT INTO programs(
    program_id,
    program_name,
    year
    ) 
    VALUES(
        '$program_id',
        '$program_name',
        '$year'
        )";

$result = mysqli_query($connect, $sql);

if($result){
    include "./plopage.php";
}else{
    echo "Failed";
}
?>