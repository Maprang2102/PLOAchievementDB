<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLO</title>
    <link rel="stylesheet" href="./css/page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include './navbar.php';
    require('./connect_program.php');
    require('./show_data.php');
    require('./select.php');
    require('./input.php')

    // $query = "SELECT * FROM courses";
    // $sql = mysqli_query($connect, $query);
    ?>

    <div class="container">
        <div class="box">
            <?php
            select_course_section()
            ?>
        </div>
    </div>
    <div class="container">
        <div class="box">
            <form method="post" style="justify-content: flex-end; display: flex;">
                <input class="btn btn-outline-primary" type="submit" name="input_clo" value="Add CLO" />
                <input class="btn btn-outline-primary" type="submit" name="import_excel" value="Upload Excel" style="margin-left: 16px;" />
            </form>
            <?php
            if (isset($_POST['input_clo'])) {
                input_CLO();
            }
            if (isset($_POST['import_excel'])) {
                importfile();
            } @$pointer = $_GET['year'];
            if ($pointer) { ?>

                <h4>CLO</h4>
                <div style="font-size:20px;">
                    <hr>
                    <?php
                    showData_clo($pointer);
                    ?>
                </div>

            <?php } else {
                echo "ไม่มีข้อมูล";
            }
            ?>
        </div>
    </div>
</body>

</html>