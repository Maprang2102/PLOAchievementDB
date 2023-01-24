<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLO</title>
    <link rel="stylesheet" href="./css/page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function postback(){
            alert("yammy");


        }


    </script>

</head>

<body>
    <?php
    require('./navbar.php');
    require('./connect_program.php');
    require('./select.php');
    require('./input.php');
    require('./show_data.php');
    require('./table.php');
    @$pointer = $_GET['program_id'];
    ?>

    <div class="container">
        <div class="box">
            <?php select_program(); ?>
        </div>
    </div>
    <?php if ($pointer) { ?>
        <div class="container">
            <div class="box" style="overflow: auto;">
                <form method="post" style="justify-content: flex-end; display: flex;">
                    <input class="btn btn-outline-primary" type="submit" name="input_plo" value="Add PLO" />
                    <input class="btn btn-outline-primary" type="submit" name="import_excel" value="Upload Excel" style="margin-left: 16px;" />
                </form>
                <?php
                if (isset($_POST['input_plo'])) {
                    input_PLO();

                }
                if (isset($_POST['import_excel'])) {
                    importfile();
                }
                showData_plo($pointer); 
                ?>
                
            </div>
        </div>
        <div class="container">
            <div class="box" style="overflow: auto;">
                <?php table_plo(); ?>
            </div>
        </div>
    <?php } ?>
</body>


</html>