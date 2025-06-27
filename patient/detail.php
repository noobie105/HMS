<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Patient's Details</title>
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
                     <h3 class="text-center" style="color: white;"><b><i><u>Your Details</u></i></b></h3>
                     <?php 
                        if(isset($_SESSION['ac'])){
                            $user = $_SESSION['ac'];
                            $query = "SELECT * FROM patient WHERE username='$user'";
                            $res = mysqli_query($connect,$query);
                            $row = mysqli_fetch_array($res);
                        }
                     ?>
                     <div class="row">
                        <div class="col-md-8">
                            <h4 style="color: white;"><b><i><u>Details</u></i></b></h4>
                            <h5 style="color: white;"><b>ID :</b> <?php echo $row['id']; ?> </h5>
                            <h5 style="color: white;"><b>First Name :</b> <?php echo $row['firstname']; ?> </h5>
                            <h5 style="color: white;"><b>Last Name :</b> <?php echo $row['lastname']; ?> </h5>
                            <h5 style="color: white;"><b>User Name :</b> <?php echo $row['username']; ?> </h5>
                            <h5 style="color: white;"><b>Email :</b> <?php echo $row['email']; ?> </h5>
                            <h5 style="color: white;"><b>Phone :</b> <?php echo $row['phone']; ?> </h5>
                            <h5 style="color: white;"><b>Gender :</b> <?php echo $row['gender']; ?> </h5>
                            <h5 style="color: white;"><b>Date of Birth :</b> <?php echo $row['birth_date']; ?> </h5>
                            <h5 style="color: white;"><b>Blood Group :</b> <?php echo $row['blood_group']; ?> </h5>
                            <h5 style="color: white;"><b>Registration Date :</b> <?php echo $row['date_reg']; ?> </h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center" style="color: white;"><b><i><u>Update Phone Number</u></i></b></h5>
                            <form method="post">
                                <label style="color: white;"><b>Enter Your Phone Number</b></label>
                                <?php
                                    if(isset($_POST['Update2'])){
                                        $phn = $_POST['phone'];
                                        $q3 = "UPDATE patient SET phone='$phn' WHERE id='$id'";
                                        mysqli_query($connect,$q3);
                                    }
                                ?>
                                <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Enter Your Phone Number">
                                <input type="submit" name="Update2" class="btn btn-primary my-3" value="Update">
                            </form>
                            <h5 class="text-center" style="color: white;"><b><i><u>Update Email</u></i></b></h5>
                            <form method="post">
                                <label style="color: white;"><b>Enter Email</b></label>
                                <?php
                                    if(isset($_POST['Update3'])){
                                        $email = $_POST['email'];
                                        $q2 = "UPDATE patient SET email='$email' WHERE id='$id'";
                                        mysqli_query($connect,$q2);
                                    }
                                ?>
                                <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter Your Email">
                                <input type="submit" name="Update3" class="btn btn-primary my-3" value="Update">
                            </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </body>
</html>