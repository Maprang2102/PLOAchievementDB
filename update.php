<?php
// require("./connect_program.php");
// if($_POST['id'])
// {
// $id=mysqli_escape_String($connect, $_POST["id"]);
// $name=mysqli_escape_String($connect, $_POST["name"]);
// $year=mysqli_escape_String($connect, $_POST["year"]);
// $sql = "UPDATE programs SET program_name='$name',year='$year' WHERE program_id='$id'";
// mysqli_query($connect,$sql);

// }
require("./connect_program.php");
if (isset($_POST["btnEdit"])) {
    $id = $_POST["editId"];
    $name = $_POST["editName"];
    $year = $_POST["editYear"];


    $query = "UPDATE programs SET program_name='$name',year='$year' WHERE program_id='$id'";
    // $result = mysqli_query($connect, $query);
    if (mysqli_query($connect, $query)) {
        header( "location: ./edit_program.php" ); 
    } else {
        echo 'fail';
    }
};
echo ("non");