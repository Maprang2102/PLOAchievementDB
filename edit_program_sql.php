<?php
require("./connect_program.php");
if (isset($_POST["btnSubmit"])) {
    $id = $_POST["txtId"];
    $name = $_POST["txtName"];

    $query = "INSERT INTO program(program_id,program_name) VALUES('$id','$name')";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header( "location: ./edit_program.php" ); 
    } else {
        echo 'fail';
    }
}

if (isset($_POST["btnDelete"])) {
    $id = $_POST["btnDelete"];
    $query = "DELETE FROM program WHERE program_id = '$id'";
    if (mysqli_query($connect, $query)) {
        header( "location: ./edit_program.php" ); 
    }
}

if (isset($_POST["btnEdit"])) {
    $id = $_POST["editId"];
    $name = $_POST["editName"];


    $query = "UPDATE program SET program_name='$name' WHERE program_id='$id'";
    // $result = mysqli_query($connect, $query);
    if (mysqli_query($connect, $query)) {
        header( "location: ./edit_program.php" ); 
    } else {
        echo 'fail';
    }
};
