<?php
include("db_connection.php");
if (!isset($_SESSION["User"])) {
    header("Location: index.php");
    exit();
}
    
?>

<html>
    <head><meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'></head>
    <body class="skin-black">
        <header class="header">
            <a href="#" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Welcome Employee
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">                
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION["User"]["employee_name"] ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $_SESSION["User"]["image"] ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION["User"]["employee_name"] ?> - <?php echo $_SESSION["User"]["department_name"] ?>
                                        <small>Member since <?php echo $_SESSION["User"]["join_date"] ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="myProfile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logOut.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo $_SESSION["User"]["image"] ?>" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Hello, <?php echo $_SESSION["User"]["employee_name"] ?></p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!--                 search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                        <span class="input-group-btn">
                            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <?php
                    if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head") {
                        echo"<li class='active'>
                        <a href='home.php'>
                            <i class='fa fa-dashboard'></i> <span>Dashboard</span>
                        </a>
                    </li>";
                    }
                    ?>

                    <li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-bar-chart-o"></i>
                            <span>Attendance</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="checkIn.php"><i class="fa fa-angle-double-right"></i> Check In</a></li>
                            <li><a href="checkOut.php"><i class="fa fa-angle-double-right"></i> Check Out</a></li>
                            <?php
                            if ($_SESSION["User"]["employee_type"] === "Admin") {
                                echo"<li><a href='viewAttendanceList.php'><i class='fa fa-angle-double-right'></i> Attendance History</a></li>";
                            }
                            ?>
                            <li><a href="personalAttendance.php"><i class="fa fa-angle-double-right"></i> Personal History</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="announcementList.php">
                            <i class="fa fa-bullhorn"></i>
                            <span>Announcement</span>
                        </a>

                    </li>
                    <?php
                    if ($_SESSION["User"]["employee_type"] === "Admin") {
                        echo"<li>
                        <a href='recruitment.php'>
                            <i class='fa fa-laptop'></i>
                            <span>Recruitment</span>
                        </a>
                    </li>
                    <li class='treeview'>
                        <a href='#'>
                            <i class='fa fa-male'></i> <span>Employee Management</span>
                            <i class='fa fa-angle-left pull-right'></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li><a href='departmentList.php'><i class='fa fa-angle-double-right'></i> Department</a></li>
                            <li><a href='scheduleList.php'><i class='fa fa-angle-double-right'></i> Schedule</a></li>
                            <li><a href='positionList.php'><i class='fa fa-angle-double-right'></i> Position</a></li>
                            <li><a href='employeeList.php'><i class='fa fa-angle-double-right'></i> Employee</a></li>
                        </ul>
                    </li>";
                    }

                    if ($_SESSION["User"]["employee_type"] === "Department Head") {
                        echo"<li class='treeview'>
                        <a href='#'>
                            <i class='fa fa-male'></i> <span>Employee Management</span>
                            <i class='fa fa-angle-left pull-right'></i>
                        </a>
                        <ul class='treeview-menu'>
                            <li><a href='employeeList.php'><i class='fa fa-angle-double-right'></i> Employee</a></li>
                        </ul>
                    </li>";
                    }
                    ?>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Leave</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="applyLeave.php"><i class="fa fa-angle-double-right"></i> Apply Leave</a></li>
                            <?php
                            if ($_SESSION["User"]["employee_type"] === "Department Head") {
                                echo"<li><a href='leaveApplication.php'><i class='fa fa-angle-double-right'></i> Leave Application</a></li>";
                                echo"<li><a href='leaveHistory.php'><i class='fa fa-angle-double-right'></i> Leave History</a></li>";
                            } else if ($_SESSION["User"]["employee_type"] === "Admin") {
                                echo"<li><a href='leaveHistory.php'><i class='fa fa-angle-double-right'></i> Leave History</a></li>";
                            }
                            ?>
                            <li><a href="leavePersonalHistory.php"><i class="fa fa-angle-double-right"></i>Personal Leave History</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-archive"></i> <span>Task Tracking</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <?php
                                if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head") {
                                    echo"<li><a href='projectList.php'><i class='fa fa-angle-double-right'></i>Project</a></li>";
                                }
                                ?>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-archive"></i> <span>Task</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if ($_SESSION["User"]["employee_type"] === "Admin" || $_SESSION["User"]["employee_type"] === "Department Head") {
                                        echo"<li><a href='taskList.php'><i class='fa fa-angle-double-right'></i> All Task</a></li>";
                                    }
                                    ?>
                                    <li><a href="taskList.php?type='1'"><i class="fa fa-angle-double-right"></i>Personal Task</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-money"></i> <span>Payroll</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">

                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-money"></i> <span>Office Expenses</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">

                                    <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-money"></i> <span>Personal Claims</span>
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href='claimExpense.php'><i class="fa fa-angle-double-right"></i>Claim Expenses</a></li>
                                            <li><a href="claimApproval.php?type1='1'"><i class='fa fa-angle-double-right'></i>Personal Pending Claim</a></li>
                                            <li><a href="claimApproval.php?type2='1'"><i class='fa fa-angle-double-right'></i>Personal Claim History</a></li>

                                        </ul>
                                    </li>
                                    <?php
                                    if ($_SESSION["User"]["employee_type"] === "Admin") {
                                        echo"<li class='treeview'><a href='#'>
                                        <i class = 'fa fa-money'></i> <span>All Claims</span>
                                        <i class = 'fa fa-angle-left pull-right'></i>
                                        </a>
                                        <ul class = 'treeview-menu'>
                                        <li><a href = 'claimApproval.php?type3='1''><i class = 'fa fa-angle-double-right'></i>Approve Claim</a></li>
                                        <li><a href = 'claimApproval.php'><i class = 'fa fa-angle-double-right'></i>Expenses Claim History</a></li>

                                        </ul>
                                        </li>";
                                    }
                                    ?>

                                </ul>
                            </li>
                            <?php
                            if ($_SESSION["User"]["employee_type"] === "Admin") {
                                echo"<li><a href='payrollList.php'><i class='fa fa-angle-double-right'></i>Salary List</a></li>";
                            }
                            ?>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class = "fa fa-user"></i> <span>Training</span>
                            <i class = "fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class = "treeview-menu">
                            <li class = "treeview">
                                <a href = "#">
                                    <i class = "fa fa-user"></i> <span>Training</span>
                                    <i class = "fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class = "treeview-menu">
                                    <?php
                                    if ($_SESSION["User"]["employee_type"] === "Admin") {
                                        echo"<li><a href='trainingList.php'><i class='fa fa-angle-double-right'></i> All Training</a></li>";
                                    }
                                    ?>
                                    <li><a href="trainingList.php?type='1'"><i class="fa fa-angle-double-right"></i>Personal Training</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-user"></i> <span>Training Result</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    if ($_SESSION["User"]["employee_type"] === "Admin") {
                                        echo"<li><a href='trainingResultList.php'><i class='fa fa-angle-double-right'></i> All Result</a></li>";
                                    }
                                    ?>
                                    <li><a href="trainingResultList.php?type='1'"><i class="fa fa-angle-double-right"></i>Personal Result</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <?php
                                if ($_SESSION["User"]["employee_type"] === "Admin") {
                                    echo"<li><a href='questionList.php'><i class='fa fa-angle-double-right'></i>Question</a></li>";
                                }
                                ?>
                            </li>
                        </ul>
                    </li>
                    <?php
                    if ($_SESSION["User"]["employee_type"] === "Admin") {
                        echo"<li>
                        <a href='report.php'>
                            <i class='fa fa-book'></i>
                            <span>Report</span>
                        </a>
                    </li>";
                    }
                    ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    </body>
</html>