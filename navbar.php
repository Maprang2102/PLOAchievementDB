<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="./css/navbar.css">

    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!--<title>Dashboard Sidebar Menu</title>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
    <?php
    session_start();
    // require('./login_sql.php');
    $role_all = [ "advisor", "student"];
    require "./session.php";
    ?>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                </span>


            </div>
            <i class='bx bx-menu toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">

                <!-- <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li> -->

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="Home.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>
                    <!-- advisor -->
                    <?php if ($_SESSION['role'] == "advisor" || $_SESSION['role'] == "admin") { ?>
                        <div>
                            <li class="nav-link">
                                <a class="program-btn">
                                    <i class='bx bx-book icon'></i>
                                    <span class="text nav-text ">Program</span>
                                    <i class='bx bxs-down-arrow arrow first text'></i>
                                </a>

                            </li>
                            <ul class="program-show">
                                <li><a href="edit_program.php">
                                        <i class='bx bxs-message-square-edit sub'></i>
                                        <span class="text nav-text ">Edit Program</span></a></li>
                                <li><a href="plopage.php">
                                        <i class='bx bxs-book sub'></i>
                                        <span class="text nav-text ">PLO</span></a></li>
                            </ul>
                        </div>
                        <div>
                            <li class="nav-link">
                                <a class="courses-btn">
                                    <i class='bx bx-message-square-check icon'></i>
                                    <span class="text nav-text ">Course</span>
                                    <i class='bx bxs-down-arrow arrow secon text'></i>
                                </a>

                            </li>
                            <ul class="courses-show">
                                <li><a href="edit_courses.php">
                                        <i class='bx bxs-message-square-edit sub'></i>
                                        <span class="text nav-text ">Edit Course</span></a></li>
                                <!-- <li><a href="clopage.php">
                                        <i class='bx bxs-book sub'></i>
                                        <span class="text nav-text ">CLO</span></a></li> -->
                                <li>
                                    <a href="course.php">
                                        <i class='bx bxs-briefcase sub'></i>
                                        <span class="text nav-text ">Course</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- <li class="nav-link">
                            <a href="clopage.php">
                                <i class='bx bx-message-square-check icon'></i>
                                <span class="text nav-text">CLO</span>
                            </a>
                        </li> -->
                        <li class="nav-link">
                            <a href="assignment.php">
                            <i class='bx bx-notepad icon'></i>
                                <span class="text nav-text">Assignment</span>
                            </a>
                        </li>
                        <div>
                            <li class="nav-link">
                                <a class="score-btn">
                                    <i class='bx bx-book icon'></i>
                                    <span class="text nav-text ">Score</span>
                                    <i class='bx bxs-down-arrow arrow third text'></i>
                                </a>

                            </li>
                            <ul class="score-show">
                                <li><a href="add_student_course.php">
                                        <i class='bx bxs-message-square-edit sub'></i>
                                        <span class="text nav-text ">Add Student</span></a></li>
                                <li><a href="add_score.php">
                                        <i class='bx bxs-book sub'></i>
                                        <span class="text nav-text ">Add Score</span></a></li>
                            </ul>
                        </div>
                        
                        <li class="nav-link">
                            <a href="chart.php">
                                <i class='bx bx-bar-chart icon'></i>
                                <span class="text nav-text">Chart</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['role'] == "student" || $_SESSION['role'] == "admin") { ?>
                        <!-- student -->
                        <li class="nav-link">
                            <a href="chart.php">
                                <i class='bx bx-bar-chart icon'></i>
                                <span class="text nav-text">Chart</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-link">
                        <a href="about.php">
                            <i class='bx bx-info-circle icon'></i>
                            <span class="text nav-text">About me</span>
                        </a>
                    </li>


                </ul>
            </div>

            <div class="bottom-content">
                <li>
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bxs-user-circle icon'></i>
                        <span class="text nav-text">user</span>
                    </a>
                    <form method="post" action="session.php">
                        <ul class="dropdown-menu" id="select_role">
                            <?php
                            for ($i = 0; $i < count($role_all); $i++) {
                            ?>
                                <a class="dropdown-item" name="data" href="?data=<?php echo $role_all[$i] ?>"><?php echo $role_all[$i] ?></a>
                            <?php } ?>
                            <a class="dropdown-item" name="edit_profile" href="edit_profile.php">Edit Profile</a>
                        </ul>
                    </form>
                </li>
                <li>
                    <a href="Home.php?data=logout">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <!-- <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li> -->

            </div>
        </div>

    </nav>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");


        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        // searchBtn.addEventListener("click", () => {
        //     sidebar.classList.remove("close");
        // })

        // modeSwitch.addEventListener("click" , () =>{
        //     body.classList.toggle("dark");

        //     if(body.classList.contains("dark")){
        //         modeText.innerText = "Light mode";
        //     }else{
        //         modeText.innerText = "Dark mode";

        //     }
        // });
    </script>
    <script>
        $('.program-btn').click(function() {
            $('nav ul .program-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        })
        $('.courses-btn').click(function() {
            $('nav ul .courses-show').toggleClass("show");
            $('nav ul .secon').toggleClass("rotate");
        })
        $('.score-btn').click(function() {
            $('nav ul .score-show').toggleClass("show");
            $('nav ul .third').toggleClass("rotate");
        })
    </script>


</body>

</html>