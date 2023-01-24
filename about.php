<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/page.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <?php
    require('./connect_program.php');
    require('./navbar.php');
    $sql = "SELECT * FROM user";
    $result = mysqli_query($connect_about, $sql);
    $count = mysqli_num_rows($result);
    $img = $connect_about->query("SELECT img FROM user ORDER BY student_id ");
    ?>
    <div class="container">
        <div class="box">
            <h4>Devloper</h4>
            <?php for ($i = 0; $i < $count; $i++) { ?>
                <?php while ($row = $img->fetch_assoc()) { ?>
                    <div class="container align-items-center">
                        <div class="col-4 card_img" style="display: flex;justify-content: center;height:200px;width:200px;overflow: hidden; text-align: center;">
                            <img style="height:200px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['img']); ?>" />
                        </div>
                        <div class="col-8 data">
                            <div class="col-9 " style="margin:10px">
                                <?php
                                $row = mysqli_fetch_array($result);
                                echo "<p>" . $row['thai_tittle'] .  "&nbsp;" . $row['thai_firstname'] .  "&nbsp;" . $row['thai_lastname'] .  "&nbsp;<br>" . $row['eng_tittle'] .  "&nbsp;" . $row['eng_firstname'] .  "&nbsp;" . $row['eng_lastname'] .  "&nbsp;<br>รหัสนิสิต: " . $row['student_id'] . "<br>" . $row['university'] .  "<br>สังกัด : " . $row['faculty'] . " " . $row['branch'] . "<br>Email :" . $row['email'] . "<br>Tel : " . $row['Tel'] . "</p>";
                                ?>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning">
                                    <?php
                                    echo "<a href='" . $row['url'] . "' class='link' >More Info..</a>";
                                    ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <?php
    require('./connect_program.php');
    $sql = "SELECT * FROM advisor";
    $result = mysqli_query($connect_about, $sql);
    $count = mysqli_num_rows($result);
    $img = $connect_about->query("SELECT * FROM `advisor` ORDER BY `advisor`.`thai_firstname` ASC");
    ?>
    <div class="container">
        <div class="box">
            <h4>Advisor</h4>
            <?php for ($i = 0; $i < $count; $i++) { ?>
                <?php while ($row = $img->fetch_assoc()) { ?>
                    <div class="container align-items-center">
                        <div class="col-4 card_img" style="display: flex;justify-content: center;height:200px;width:200px;overflow: hidden; text-align: center;">
                            <img style="height:200px;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['img']); ?>" />
                        </div>
                        <div class="col-8 data">
                            <div class="col-9 " style="margin:10px">
                                <?php
                                $row = mysqli_fetch_array($result);
                                echo "<p>" . $row['academic_rank'] .  "&nbsp;" . $row['thai_firstname'] .  "&nbsp;" . $row['thai_lastname'] .  "&nbsp;<br>" . $row['eng_academic_rank'] .  "&nbsp;" . $row['eng_firstname'] .  "&nbsp;" . $row['eng_lastname'] .  "<br>" . $row['university'] .  "<br>สังกัด : " . $row['faculty'] . " " . $row['branch'] . "<br>Email :" . $row['email'] . "<br>Tel : " . $row['Tel'] . "</p>";
                                ?>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-warning">
                                    <?php
                                    echo "<a href='" . $row['url'] . "' class='link' >More Info..</a>";
                                    ?>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</body>
<style>
    [class*="imge"] {
        display: flex;
        align-content: center;
        justify-content: center;
        margin: 10px;
    }

    [class*="img"] {
        height: 200px;
        border-radius: 10px;
    }

    [class*="data"] {
        border-radius: 10px;
        border: 1px solid #7A7A7A;
        font-size: 20px;
        padding: 10px;
        margin: 10px;
        min-width: 370px;
        display: flex;
        align-items: center;
    }
    [class*="link"] { 
        text-decoration: none;
        color: #000;
    }
           
        
</style>

</html>