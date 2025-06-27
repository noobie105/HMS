<?php
session_start();
include "connection.php";
$error = array();
if(isset($_POST['signup'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $birth_date= $_POST['birth_date'];
    $blood_group = $_POST['blood_group'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['con_pass'];


    if(empty($firstname)){
        $error['ac'] = "Enter First Name";
    }else if(empty($lastname)){
        $error['ac'] = "Enter Last Name";
    }else if(empty($username)){
        $error['ac'] = "Enter User Name";
    }else if(empty($email)){
        $error['ac'] = "Enter Email";
    }else if(empty($phone)){
        $error['ac'] = "Enter Phone Number";
    }else if($gender == ""){
        $error['ac'] = "Select Your Gender";
    }else if(empty($birth_date)){
        $error['ac'] = "Enter Your Date of Birth";
    }else if(empty($blood_group)){
        $error['ac'] = "Enter Your Blood Group";
    }else if(empty($password)){
        $error['ac'] = "Enter Password";
    }else if($confirm_password != $password){
        $error['ac'] = "Password Didn't Match! Re-enter Please.";
    }
}

if(isset($_POST['signup']) && count($error)==0){
    $query = "INSERT INTO patient(firstname, lastname, username, email, phone, gender, birth_date, blood_group, password, date_reg, profile) VALUES('$firstname', '$lastname', '$username','$email', '$phone','$gender','$birth_date','$blood_group',
    '$password',NOW(),'patient3.jpeg')";

    $result = mysqli_query($connect,$query);
    if($result){
        echo "<script>alert('Account Created Successfully!')</script>";
        header("Location: patient_login.php");
    }else{
        echo "<script>alert('Sign Up Failed!)</script>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
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
                    <h3 class="text-center"><b><i>Sign Up</i></b></h3> 
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
                                <label><b>Date of Birth</b></label>
                                <input type="text" name="birth_date" class="form-control" autocomplete="off" placeholder="Enter Your Date of Birth"
                                value="<?php if(isset($_POST['birth_date'])) echo $_POST['birth_date']; ?>">
                            </div>
                            <div class ="form-group">
                                <label><b>Blood Group</b></label>
                                <input type="text" name="blood_group" class="form-control" autocomplete="off" placeholder="Enter Your Blood Group"
                                value="<?php if(isset($_POST['blood_group'])) echo $_POST['blood_group']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label><b>Password</b></label>
                                <input type="text" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                            </div>
                            <div class="form-group">
                                <label><b>Confirm Password</b></label>
                                <input type="text" name="con_pass" class="form-control" autocomplete="off" placeholder="Confirm Password">
                            </div>
                            <input type="submit" name="signup" class="btn btn-info my-3" value="Sign Up">
                            <p>Already Have an account? <a href="patient_login.php">Log in.</a></p>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>