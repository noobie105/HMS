<?php
session_start();
include "connection.php";
$error = array();
if(isset($_POST['apply'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $medical = $_POST['medi'];
    $education = $_POST['edu'];
    $experiencce = $_POST['exp'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];


    if(empty($firstname)){
        $error['apply'] = "Enter First Name";
    }else if(empty($lastname)){
        $error['apply'] = "Enter Last Name";
    }else if(empty($username)){
        $error['apply'] = "Enter User Name";
    }else if(empty($email)){
        $error['apply'] = "Enter Email";
    }else if(empty($phone)){
        $error['apply'] = "Enter Phone Number";
    }else if($gender == ""){
        $error['apply'] = "Select Your Gender";
    }else if(empty($medical)){
        $error['apply'] = "Enter Your Medical College";
    }else if(empty($education)){
        $error['apply'] = "Enter Your Educational Details";
    }else if(empty($experiencce)){
        $error['apply'] = "Enter Your Working Experience";
    }else if(empty($password)){
        $error['apply'] = "Enter Password";
    }else if($confirm_password != $password){
        $error['apply'] = "Password Didn't Match! Re-enter Please.";
    }
}

if(isset($_POST['apply']) && count($error)==0){
    $query = "INSERT INTO doctors(first_name, last_name, username, email, phone, gender, medical_college,education, experience, password, salary, data_reg, 
    status, profile) VALUES('$firstname', '$lastname', '$username','$email', '$phone','$gender','$medical','$education','$experience','$password','0',NOW(),'Pending','doctor2.jpeg')";

    $result = mysqli_query($connect,$query);
    if($result){
        echo "<script>alert('You've Successfully applied!')</script>";
        header("Location: doctor_login.php");
    }else{
        echo "<script>alert('Application Failed!')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Appication For Doctors</title>
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
            include("header.php");
        ?>

        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                <div class = "col-md-3"></div>
                <div class="col-md-6 my-3 jumbotron">
                    <h3 class="text-center"><b><i>Application</i></b></h3> 
                    <form method ="post"  enctype ="multipart/form-data">
                    <div>
                            <?php
                                if(isset($error['apply'])){
                                    $sh = $error['apply'];
                                    $show = '<h6 class ="text-center alert alert-danger ">'.$sh.'</h6>';
                                }else{
                                    $show = '';
                                }
                                echo $show;
                            ?>
                        </div>
                        <div class="form-group">
                            <lable><b>First Name</b></lable>
                            <input type="text" name="fname" class="form-control" autocomplete="off" placeholder="Enter First Name"
                            value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Last Name</b></label>
                                <input type="text" name="lname" class="form-control" autocomplete="off" placeholder="Enter Last Name"
                                value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>User Name</b></label>
                                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter User Name"
                                value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Email</b></label>
                                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email Address"
                                value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Phone Number</b></label>
                                <input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter Phone Number"
                                value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Select Gender</b></label>
                                <select name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class ="form-group">
                                <label><b>Medical College</b></label>
                                <input type="text" name="medi" class="form-control" autocomplete="off" placeholder="Enter Name of Medical College"
                                value="<?php if(isset($_POST['medi'])) echo $_POST['medi']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Add Educational Details</b></label>
                                <input type="text" name="edu" class="form-control" autocomplete="off" placeholder="Enter Educational History"
                                value="<?php if(isset($_POST['edu'])) echo $_POST['edu']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Working Experience</b></label>
                                <input type="text" name="exp" class="form-control" autocomplete="off" placeholder="Experience of Working As a Doctor"
                                value="<?php if(isset($_POST['exp'])) echo $_POST['exp']; ?>">
                            </div>
                            <div class="form-group">
                                <label><b>Password</b></label>
                                <input type="text" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label><b>Confirm Password</b></label>
                                <input type="text" name="con_pass" class="form-control" autocomplete="off" placeholder="Confirm Password">
                            </div>
                            <input type="submit" name="apply" class="btn btn-info my-3" value="Apply Now">
                            <p>Already Have an account? <a href="doctor_login.php">Log in.</a></p>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>