<?php
require('./connect_program.php');
if (isset($_POST["btnAdd"])) {
    $course_id = $_POST['course_id'];
    $clo_code = $_POST['clo_code'];
    $clo_name = $_POST['clo_name'];
    $clo_engname = $_POST['clo_nameeng'];;
    $clo_year = $_POST['clo_year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $program_id = $_POST['program_id'];
    echo " course : ".$course_id." course : ".$clo_code." course : ".$clo_name." course : ".$clo_engname." course : ".$clo_year." course : ".$semester." course : ".$section;
    $course_spl = "INSERT INTO clo(clo_code,clo_name,clo_engname) VALUE('$clo_code','$clo_name','$clo_engname')";

    $result = mysqli_query($connect, $course_spl);
    
    $max = "SELECT MAX(clo_id) as 'clo_id' FROM clo";
    $query = mysqli_fetch_array(mysqli_query($connect, $max));
    $clo_id = $query['clo_id'];

    $course_clo = "INSERT INTO course_clo(course_id,clo_id,year_str,semester_id,section_id) VALUE('$course_id','$clo_id','$clo_year','$semester','$section')";

    $result1 = mysqli_query($connect, $course_clo);

    if ($result1) {
        header("location: ./course.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year);
    } else {
        echo "Failed";
    }
}
if (isset($_POST["btnEdit"])) {
    $id = $_POST["Ploid"];
    $clo_name = $_POST["editName"];
    $clo_engname = $_POST["editNameeng"];
    $course_id = $_POST['course_id'];
    $clo_year = $_POST['clo_year'];
    $semester = $_POST['semester'];
    $section = $_POST['section'];
    $program_id = $_POST['program_id'];
    // echo $id;
    $edit = "UPDATE clo SET clo_name='$clo_name',clo_engname='$clo_engname' WHERE clo_id='$id'";
    $result = mysqli_query($connect, $edit);
    if ($result) {
        header("location: ./course.php?program_id=".$program_id."&course=".$course_id."&section=".$section."&semester=".$semester."&year=".$clo_year);
    }
    else{
        echo "fail";
    }
}
