<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Report</title>
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
            include("../header.php"); 
        ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" style = "margin-left : -30px;">
                    <?php 
                        include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                     <h3 class="text-center" style="color: white;"><b><i><u>Report Details</u></i></b></h3>
                     <?php 
                        if(isset($_GET['username'])){
                            $user = $_GET['username'];
                            $query = "SELECT * FROM report WHERE username='$user'";
                            $res = mysqli_query($connect,$query);
                            $row = mysqli_fetch_array($res);
                        }
                     ?>
                     <div class="row">
                        <div class="col-md-8">
                            <h4 style="color: white;"><b><i><u>Details</u></i></b></h4>
                            <h5 style="color: white;"><b>ID :</b> <?php echo $row['id']; ?> </h5>
                            <h5 style="color: white;"><b>User Name :</b> <?php echo $row['username']; ?> </h5>
                            <h5 style="color: white;"><b>Title :</b> <?php echo $row['title']; ?> </h5>
                            <h5 style="color: white;"><b>Message :</b> <?php echo $row['message']; ?> </h5>
                            <h5 style="color: white;"><b>Reporting Date:</b> <?php echo $row['date_send']; ?> </h5>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </body>
</html>