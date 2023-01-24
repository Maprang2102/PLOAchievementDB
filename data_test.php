
<?php 
    header('Content-Type: application/json');

    require_once 'connect_program.php';

    $sqlQuery = "SELECT * FROM assignment ";
    $result = mysqli_query($connect, $sqlQuery);

    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    mysqli_close($connect);

    echo json_encode($data);

?>