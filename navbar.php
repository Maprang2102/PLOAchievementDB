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
    if ($_SESSION['all_role'] == 'admin') {
        $role_all = ["advisor", "student"];
    } elseif ($_SESSION['all_role'] == 'advisor') {
        $role_all = ["advisor"];
    } elseif ($_SESSION['all_role'] == 'student') {
        $role_all = ["student"];
    } elseif ($_SESSION['all_role'] == 'user' || $_SESSION['all_role'] == 'normal') {
        $role_all = [""];
    }
    require "./session.php";
    // require "./login_sql.php";
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


                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="Home.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">หน้าแรก</span>
                        </a>
                    </li>
                    <!-- advisor -->
                    <?php if ($_SESSION['role'] == "advisor" || $_SESSION['role'] == "admin") { ?>
                        <div>
                            <li class="nav-link">
                                <a class="program-btn">
                                    <i class='bx bx-book icon'></i>
                                    <span class="text nav-text ">หลักสูตร</span>
                                    <i class='bx bxs-down-arrow arrow first text'></i>
                                </a>

                            </li>
                            <ul class="program-show">
                                <li><a href="edit_program.php">
                                        <i class='bx bxs-message-square-edit sub'></i>
                                        <span class="text nav-text ">แก้ไขหลักสูตร</span></a></li>
                                <li><a href="plopage.php">
                                        <i class='bx bxs-book sub'></i>
                                        <span class="text nav-text ">PLO</span></a></li>
                            </ul>
                        </div>
                        <div>
                            <li class="nav-link">
                                <a class="courses-btn">
                                    <i class='bx bx-message-square-check icon'></i>
                                    <span class="text nav-text ">รายวิชา</span>
                                    <i class='bx bxs-down-arrow arrow secon text'></i>
                                </a>

                            </li>
                            <ul class="courses-show">
                                <li><a href="edit_courses.php">
                                        <i class='bx bxs-message-square-edit sub'></i>
                                        <span class="text nav-text ">แก้ไขรายวิชา</span></a></li>
                                <!-- <li><a href="clopage.php">
                                        <i class='bx bxs-book sub'></i>
                                        <span class="text nav-text ">CLO</span></a></li> -->
                                <li>
                                    <a href="course.php">
                                        <i class='bx bxs-briefcase sub'></i>
                                        <span class="text nav-text ">CLO</span>
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
                                <span class="text nav-text">งานที่มอบหมาย</span>
                            </a>
                        </li>
                        <div>
                            <li class="nav-link">
                                <a class="score-btn">
                                    <i class='bx bx-book icon'></i>
                                    <span class="text nav-text ">คะแนน</span>
                                    <i class='bx bxs-down-arrow arrow third text'></i>
                                </a>

                            </li>
                            <ul class="score-show">
                                <li><a href="add_student_course.php">
                                        <i class='bx bxs-message-square-edit sub'></i>
                                        <span class="text nav-text ">เพิ่มรายชื่อนิสิต</span></a></li>
                                <li><a href="add_score.php">
                                        <i class='bx bxs-book sub'></i>
                                        <span class="text nav-text ">เพิ่มคะแนน</span></a></li>
                            </ul>
                        </div>

                        <li class="nav-link">
                            <a href="chart.php">
                                <i class='bx bx-bar-chart icon'></i>
                                <span class="text nav-text">กราฟวิเคราะห์</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($_SESSION['role'] == "student" || $_SESSION['role'] == "admin") { ?>
                        <!-- student -->
                        <li class="nav-link">
                            <a href="chart_student.php">
                            <i class='bx bx-bar-chart-alt-2 icon' ></i>
                                <span class="text nav-text">กราฟวิเคราะห์นิสิต</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="nav-link">
                        <a href="about.php">
                            <i class='bx bx-info-circle icon'></i>
                            <span class="text nav-text">เกี่ยวกับ</span>
                        </a>
                    </li>


                </ul>
            </div>
            <?php if ($_SESSION['role'] != 'normal') { ?>
                <div class="bottom-content">
                    <li>
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bxs-user-circle icon'></i>
                            <span class="text nav-text">ผู้ใช้งาน</span>
                        </a>
                        <form method="post" action="session.php">
                            <ul class="dropdown-menu" id="select_role">
                                <?php
                                for ($i = 0; $i < count($role_all); $i++) {
                                ?>
                                    <a class="dropdown-item" name="data" href="?data=<?php echo $role_all[$i] ?>"><?php echo $role_all[$i] ?></a>
                                <?php } ?>
                                <a class="dropdown-item" name="edit_profile" href="edit_profile.php">แก้ไขผู้ใช้งาน</a>
                            </ul>
                        </form>
                    </li>
                    <li>
                        <a href="Home.php?data=logout">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">ออกจากระบบ</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="Home.php?data=login">
                            <i class='bx bx-log-in icon'></i>
                            <span class="text nav-text">เข้าสู่ระบบ</span>
                        </a>
                    </li>
                <?php } ?>
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