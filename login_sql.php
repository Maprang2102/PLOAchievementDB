<?php 
require('./connect_program.php');
$role_all = [];
if(isset($_POST['signup'])){
    $username = $_POST['user_regis'];
    $id = $_POST['id_regis'];
    $pass = $_POST['pass_regis'];

    $sql = "INSERT INTO user(username,password,id) VALUE('$username','$pass','$id') ";
    $result = mysqli_query($connect, $sql);
    $role_cass = "normal";
    header("location: ./Home.php");

}
if(isset($_POST['signin'])){
    $username = $_POST['user_login'];
    $password = $_POST['pass_login'];
    $username = "maprang";
    $password = "Pr@ng";
    // $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    // $id = mysqli_query($connect, $sql);
    // while($id1 = mysqli_fetch_array($id)){
    //     $user_id = $id1['id'];
    // }
    $role_cass = "normal";
    $check = mysqli_query($connect,"SELECT `student`.`student_id`,`teacher`.`teacher_id` FROM `user` left join `student` on `user`.`id` = `student`.`student_id` left join `teacher` on `teacher`.`teacher_id` = `user`.`id` WHERE username = '$username' and password = '$password'");
    while($userrole = mysqli_fetch_array($check)){
        echo $userrole['student_id'];
        if(isset($userrole['student_id'])&&isset($userrole['teacher_id'])){
            $role_cass = "admin";
            $role_all = ["student","advisor"];
        }
        elseif(isset($userrole['student_id'])){
            $role_cass = "student";
            $role_all = ["student"];
        }
        elseif(isset($userrole['teacher_id'])){
            $role_cass = "advisor";
            $role_all = ["advisor"];
        }
    }
    
    // echo "<hr>";
    
    // print_r($role_all);
    
    
   

}
// echo "role_cass:".$role_cass ;
// require('./session.php');
// echo "role_cass:".$role_cass ;
// header("location: ./Home.php");
