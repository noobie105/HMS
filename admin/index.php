<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin's Dashboard</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


        <link rel="stylesheet" type="text/css" href="homepage.css">

        <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


    </head>

    <body>
    <?php
        include("../connection.php");
    ?>
    <nav class="navbar navbar-expand-lg  navbar-info bg-info">
        <h5 class="text-white">Admin Profile</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['admin'])){
                    $user = $_SESSION['admin'];
                    echo '<li class="nav-item"> <a href="#" class="nav-link text-white">'.$user.'</a></li>
                    <li class="nav-item"> <a href="logout.php" class="nav-link text-white">Log Out</a></li>';     
                }
            ?>
           
        </ul>
    </nav>

    <div class ="container-fluid">
        <div class = "col-md-12">
            <div class = "row">
                <div class = "col-md-2" style="margin-left : -32px">
                    
                <?php
                    include("sidenav.php");
                ?>

                </div>
                <div class ="col-md-10">
                <h3 class = "my-2"><b><i><u>Admin's Dashboard</u></i></b></h3>
                <div class = "col-md-12 my-1">
                    <div class = "row">

                        <div class = "col-md-3 bg-success mx-2" style = "height : 130px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <?php
                                            $ad = mysqli_query($connect, "SELECT * FROM admin");
                                            $num = mysqli_num_rows($ad);
                                        ?>
                                        <h5 class = "my-2 text-white" style = "font-size : 30px;">
                                            <?php echo $num; ?>
                                    </h5>
                                        <h5 class = "text-white">Total</h5>
                                        <h5 class = "text-white">Admin</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href = "admin.php"><i class = "fa fa-users-cog fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "col-md-3 bg-primary mx-2" style = "height : 130px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <?php
                                            $doc = mysqli_query($connect,"SELECT * FROM doctors WHERE status='Approved'");
                                            $num2 = mysqli_num_rows($doc);
                                        ?>
                                        <h5 class = "my-2 text-white" style = "font-size : 30px;">
                                    <?php echo $num2; ?></h5>
                                        <h5 class = "text-white">Total</h5>
                                        <h5 class = "text-white">Doctors</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href="doctor.php"><i class = "fa fa-user-md fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "col-md-3 bg-warning mx-2" style = "height : 130px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <?php
                                            $doc = mysqli_query($connect,"SELECT * FROM patient");
                                            $num4 = mysqli_num_rows($doc);
                                        ?>
                                        <h5 class = "my-2 text-white" style = "font-size : 30px;"><?php echo $num4; ?></h5>
                                        <h5 class = "text-white">Total</h5>
                                        <h5 class = "text-white">Patients</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href="patient.php"><i class = "fa fa-procedures fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "col-md-3 bg-warning mx-2 my-2" style = "height : 130px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <?php
                                            $doc = mysqli_query($connect,"SELECT * FROM report");
                                            $num5 = mysqli_num_rows($doc);
                                        ?>
                                        <h5 class = "my-2 text-white" style = "font-size : 30px;"><?php echo $num5; ?></h5>
                                        <h5 class = "text-white">Total</h5>
                                        <h5 class = "text-white">Report</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href="#"><i class = "fa fa-flag fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "col-md-3 bg-danger mx-2 my-2" style = "height : 130px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                    <?php
                                            $job = mysqli_query($connect, "SELECT * FROM doctors WHERE status='Pending'");
                                            $num1 = mysqli_num_rows($job);
                                        ?>
                                        <h5 class = "my-2 text-white" style = "font-size : 30px;"><?php echo $num1; ?></h5>
                                        <h5 class = "text-white">Total</h5>
                                        <h5 class = "text-white">Job Requests</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href="job_request.php"><i class = "fa fa-book-open fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                    </div>
                </div>
            </div>
            </div>

        </div>

    </div>

    
    </body>
</html>