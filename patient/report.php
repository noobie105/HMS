<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Report</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="homepage.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type ="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <style>
            body {
                background-image: url('img/hospital.jpeg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                background-attachment: fixed; /* This keeps the background fixed while scrolling */
            }
            
            .blur-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0.5, 0.5, 0.5);
                backdrop-filter: blur(10px); /* Apply a blur effect */
                z-index: -1; /* Place behind other content */
            }
        </style>
    </head>
    <body>
    <div class="blur-overlay"></div>
    <?php
        include("../connection.php");
    ?>
    <nav class="navbar navbar-expand-lg  navbar-info bg-info">
        <h5 class="text-white">Patient's Dashboard</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['ac'])){
                    $user = $_SESSION['ac'];
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

                <?php 
                
                    if(isset($_POST['send'])){
                        $title = $_POST['title'];
                        $message = $_POST['message'];

                        if(empty($title)){

                        }else if(empty($message)){

                        }else{
                            $query = "INSERT INTO report(title, message, username, date_send) VALUES('$title','$message','$user',NOW())";
                            $res = mysqli_query($connect,$query);
                            if($res){
                                echo "<script>alert('You have sent your report!')</script>";
                            }
                        }
                    }
                ?>

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-4 jumbotron bg-dark my-4">
                            <h5 class="text-center my-2 text-white">Send A Report</h5>
                            <form method="post">
                                <lable class="text-white">Title</lable>
                                <input type="text" name="title" aria-autocomplete="off" class="form-control" placeholder="Enter Title">
                                <lable class="text-white">Message</lable>
                                <input type="text" name="message" aria-autocomplete="off" class="form-control" placeholder="Enter Message">
                                <input type="submit" name="send" value="Send Report" class="btn btn-danger my-2">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
            </div>

        </div>

    </div>
    </body>
</html>