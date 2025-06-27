<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Total Appointments</title>

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
        <?php
            include("../connection.php");
        ?>

        <div class = "container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2" style = "margin-left : -30px;">
                        <?php
                            include("sidenav.php");
                        ?>
                    </div>
                    <div class="col-md-10">
                        <h3 class="text-center"><b><i>Appointments Details</i></b></h3>
                        <?php
                            $query = "SELECT * FROM appointment";
                            $res = mysqli_query($connect,$query);

                            $output ="";
                            $output .= "

                                <table class = 'table table-bordered'>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Problem Description</th>
                                    <th>Check-Up Date</th>
                                    <th>Appointment</th>
                                </tr>

                            ";
                            if(mysqli_num_rows($res)<1){
                                $output .= "
                                <tr>
                                <td colspan='10' class='text-center'>No Appointment.
                                </td>
                                </tr>
                                ";
                            }

                            while($row = mysqli_fetch_array($res)){
                                $output .= "
                                <tr>
                                    <td>".$row['username']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['department']."</td>
                                    <td>".$row['problem']."</td>
                                    <td>".$row['date']."</td>
                                    <td>
                                        <div class='col-md-12'>
                                            <div class='row'>
                                                <div class='col-md-6'>
                                                    <button id='".$row['id']."' class='btn btn-success approve'>Accept</button>
                                                </div>
                                                <div class='col-md-6'>
                                                    <button id='".$row['id']."' class='btn btn-danger reject'>Pass</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                ";
                            }

                            $output .="</table>";
                            echo $output;
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>