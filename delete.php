<?php
require("./connect_program.php");
if (isset($_POST["btnDelete"])) {
    $id = $_POST["btnDelete"];
    $query = "DELETE FROM programs WHERE program_id = '$id'";
    if (mysqli_query($connect, $query)) {
        header( "location: ./edit_program.php" ); 
    }
}
?>
