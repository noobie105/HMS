<?php
session_start();
include "..\connection.php";
$error = array();
if(isset($_POST['book'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $problem = $_POST['problem'];
    $date = $_POST['date'];

    if(empty($username)){
        $error['book'] = "Enter User Name";
    }else if(empty($email)){
        $error['book'] = "Enter Email";
    }else if(empty($department)){
        $error['book'] = "Enter Department";
    }else if(empty($problem)){
        $error['book'] = "Enter Problem";
    }else if(empty($date)){
        $error['book'] = "Enter Date";
    }
}

if(isset($_POST['book']) && count($error)==0){
    $query = "INSERT INTO appointment(username, email, department, problem, date) 
    VALUES('$username','$email', '$department','$problem','$date')";

    $result = mysqli_query($connect,$query);
    if($result){
        echo "<script>alert('Booked Appointment Successfully!')</script>";
        header("Location: index.php");
    }else{
        echo "<script>alert('Booking Failed!)</script>";
    }
}else if(isset($_POST['back'])){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Book Appointment</title>
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
            include("..\header.php");
        ?>

        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                <div class = "col-md-3"></div>
                <div class="col-md-6 my-3 jumbotron">
                    <h3 class="text-center"><b><i>Book Appointment</i></b></h3> 
                    <form method ="post"  enctype ="multipart/form-data">
                    <div>
                            <?php
                                if(isset($error['ac'])){
                                    $sh = $error['ac'];
                                    $show = '<h6 class ="text-center alert alert-danger ">'.$sh.'</h6>';
                                }else{
                                    $show = '';
                                }
                                echo $show;
                            ?>
                        </div>
                        <div class="form-group">
                            <lable><b>User Name</b></lable>
                            <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Enter User Name"
                            value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Email</b></label>
                                <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter Email"
                                value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Medical Department</b></label>
                                <input type="text" name="department" class="form-control" autocomplete="off" placeholder="Enter Name of The Department"
                                value="<?php if(isset($_POST['department'])) echo $_POST['department']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Sickness Details</b></label>
                                <input type="text" name="problem" class="form-control" autocomplete="off" placeholder="Enter Details"
                                value="<?php if(isset($_POST['problem'])) echo $_POST['problem']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label><b>Check Up Date</b></label>
                                <input type="text" name="date" class="form-control" autocomplete="off" placeholder="Enter The Date You Want to Check Up">
                            </div>
                            <input type="submit" name="book" class="btn btn-success my-3" value="Book Appointment Now">
                            <br>
                            <input type="submit" name="back" value="Later" class="btn btn-danger my-2">
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>