<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Doctor Detail</title>
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
                     <h3 class="text-center" style="color: white;"><b><i><u>Edit Details</u></i></b></h3>
                     <?php 
                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $query = "SELECT * FROM doctors WHERE id='$id'";
                            $res = mysqli_query($connect,$query);
                            $row = mysqli_fetch_array($res);
                        }
                     ?>
                     <div class="row">
                        <div class="col-md-8">
                            <h4 style="color: white;"><b><i><u>Details</u></i></b></h4>
                            <h5 style="color: white;"><b>ID :</b> <?php echo $row['id']; ?> </h5>
                            <h5 style="color: white;"><b>First Name :</b> <?php echo $row['first_name']; ?> </h5>
                            <h5 style="color: white;"><b>Last Name :</b> <?php echo $row['last_name']; ?> </h5>
                            <h5 style="color: white;"><b>User Name :</b> <?php echo $row['username']; ?> </h5>
                            <h5 style="color: white;"><b>Email :</b> <?php echo $row['email']; ?> </h5>
                            <h5 style="color: white;"><b>Phone :</b> <?php echo $row['phone']; ?> </h5>
                            <h5 style="color: white;"><b>Gender :</b> <?php echo $row['gender']; ?> </h5>
                            <h5 style="color: white;"><b>Medical College :</b> <?php echo $row['medical_college']; ?> </h5>
                            <h5 style="color: white;"><b>Educational Details :</b> <?php echo $row['education']; ?> </h5>
                            <h5 style="color: white;"><b>Working Experience :</b> <?php echo $row['experience']; ?> </h5>
                            <h5 style="color: white;"><b>Joining Date :</b> <?php echo $row['data_reg']; ?> </h5>
                            <h5 style="color: white;"><b>Salary :</b> <?php echo $row['salary']; ?> </h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center" style="color: white;"><b><i><u>Update Salary</u></i></b></h5>
                            <form method="post">
                                <label style="color: white;"><b>Enter Updated Salary</b></label>
                                <?php
                                    if(isset($_POST['Update'])){
                                        $salary = $_POST['salary'];
                                        $q = "UPDATE doctors SET salary='$salary' WHERE id='$id'";
                                        mysqli_query($connect,$q);
                                    }
                                ?>
                                <input type="number" name="salary" class="form-control" autocomplete="off" placeholder="Enter Amount">
                                <input type="submit" name="Update" class="btn btn-primary my-3" value="Update">
                            </form>
                            <h5 class="text-center" style="color: white;"><b><i><u>Update Phone Number</u></i></b></h5>
                            <form method="post">
                                <label style="color: white;"><b>Enter Your Phone Number</b></label>
                                <?php
                                    if(isset($_POST['Update2'])){
                                        $phn = $_POST['phone'];
                                        $q3 = "UPDATE doctors SET phone='$phn' WHERE id='$id'";
                                        mysqli_query($connect,$q3);
                                    }
                                ?>
                                <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Phone Number">
                                <input type="submit" name="Update2" class="btn btn-primary my-3" value="Update">
                            </form>
                            <h5 class="text-center" style="color: white;"><b><i><u>Update Experience</u></i></b></h5>
                            <form method="post">
                                <label style="color: white;"><b>Enter Your Experience</b></label>
                                <?php
                                    if(isset($_POST['Update3'])){
                                        $exp = $_POST['experience'];
                                        $q2 = "UPDATE doctors SET experience='$exp' WHERE id='$id'";
                                        mysqli_query($connect,$q2);
                                    }
                                ?>
                                <input type="text" name="experience" class="form-control" autocomplete="off" placeholder="Experience">
                                <input type="submit" name="Update3" class="btn btn-primary my-3" value="Update">
                            </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </body>
</html>