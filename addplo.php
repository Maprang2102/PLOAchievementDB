<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    
    <div class="dropdown">
        <div data-bs-toggle="dropdown" id="menu1">here</div>
        <ul class="dropdown-menu thenumbers" aria-labelledby="menu1" name="thenumbers">
            <li value="advisor">Advisor</li>
            <li value="student">Student</li>
        </ul>
    </div>
    <li>
        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <i class='bx bxs-user-circle icon'></i>
            <span class="text nav-text">user</span>
        </a>
        <ul class="dropdown-menu thenumbers" name="thenumbers">
            <li><a class="dropdown-item" value="advisor">Advisor</a></li>
            <li><a class="dropdown-item" value="student">Student</a></li>
        </ul>
    </li>
    

    <!-- Create a hidden input -->
    <input type='text' name='thenumbers'>
    <!-- <?php echo @$_SESSION["level"]; ?> -->

    <?php if(@$_SESSION["level"] == "advisor" ){
        echo "<p>advisor</p>";
    } ?>
    <script>
        $(function() {
            //Listen for a click on any of the dropdown items
            $(".thenumbers li a").click(function() {
                //Get the value
                var value = $(this).attr("value");
                //Put the retrieved value into the hidden input
                var role = $("input[name='thenumbers']").val(value);
                alert("OK IT WORKS");
                '<?php $_SESSION["level"] = "' + value + '"; ?>';
                if(value == 'advisor'){
                    alert('<?php echo $_SESSION["level"] ?>');
                    // location.reload();
            }
            else if(value == 'student'){
                    alert('<?php echo $_SESSION["level"] ?>');
                    // location.reload();
            }
            });
        });
        $(function check(){
            
        })
        $.get(
            ""
        )
    </script>
    <?php echo $_SESSION["level"]; ?>
</body>

</html>