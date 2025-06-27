<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Doctor's Dashboard</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="homepage.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    </head>
    <body>
    <?php
        include("../connection.php");
    ?>
    <nav class="navbar navbar-expand-lg  navbar-info bg-info">
        <h5 class="text-white">Doctor's Dashboard</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['doctor'])){
                    $user = $_SESSION['doctor'];
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
                <h3 class = "my-2"><b><i><u>Doctor's Dashboard</u></i></b></h3>
                <div class = "col-md-12 my-1">
                    <div class = "row">

                        <div class = "col-md-3 bg-danger mx-1" style = "height : 150px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <h5 class = "text-white my-4" style="font-size:30px">My Profile</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href = "profile.php"><i class = "fa fa-user-circle fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "col-md-3 bg-warning mx-1" style = "height : 150px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <?php
                                            $doc = mysqli_query($connect,"SELECT * FROM patient");
                                            $num = mysqli_num_rows($doc);
                                        ?>
                                        <h5 class = "text-white my-2" style="font-size: 40px;"><?php echo $num; ?></h5>
                                        <h5 class = "text-white" style="font-size: 25px;">Total</h5>
                                        <h5 class = "text-white" style="font-size: 25px;">Patient</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href="patient.php"><i class = "fa fa-procedures fa-3x my-4" style ="color : white;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "col-md-3 bg-success mx-1" style = "height : 150px">
                            <div class = "col-md-12">
                                <div class = "row">
                                    <div class = "col-md-8">
                                        <?php
                                            $doc = mysqli_query($connect,"SELECT * FROM appointment");
                                            $num2 = mysqli_num_rows($doc);
                                        ?>
                                        <h5 class = "text-white my-2" style="font-size: 40px;"><?php echo $num2;?></h5>
                                        <h5 class = "text-white" style="font-size: 25px;">Total</h5>
                                        <h5 class = "text-white" style="font-size: 25px;">Appointment</h5>
                                    </div>
                                    <div class = "col-md-4">
                                        <a href="appointment.php"><i class = "fa fa-calendar fa-3x my-4" style ="color : white;"></i></a>
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