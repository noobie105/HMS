<?php
    session_start();
    include "connection.php";
    
    if(isset($_POST['login'])){
        $uname = $_POST['uname'];
        $pass = $_POST['pass'];
        $error = array();

        $q = "SELECT * FROM doctors WHERE username = '$uname' AND password = '$pass' ";
        $qq = mysqli_query($connect,$q);
        $row = mysqli_fetch_array($qq);

        if(empty($uname)){
            $error['login'] = "Enter Username";
        }else if(empty($pass)){
            $error['login'] = "Enter Password";
        }else if($row['status']=="Pending"){
            $error['login'] = "Please wait for application confirmation.";
        }else if($row['status']=="Rejected"){
            $error['login'] = "Sorry. Invalid User.";
        }
    }

    if(isset($_POST['login']) && count($error)==0){
        $query = "SELECT * FROM doctors WHERE username = '$uname' AND password = '$pass' ";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result)==1){
            echo "<script>alert('You have successfully logged in!')</script>";
             $_SESSION ['doctor'] = $uname;
             header("Location: doctor/index.php");
             }else{
                echo "<script>alert('Invalid Username or Password')</script>";
            }
    }

?>

<!DOCTYPE html>
<head>
    <title>Dcotor Login Page</title>
</head>
<body style="background-image : url(img/hospital.jpeg); background-repeat: no-repeat; background-size: cover;" >
<?php
    include ("header.php");
    ?>
<div style="margin-top: 20px;"></div>
<div class="container">
    <div class="col-md-12">
        <div class="row">
        <div class = "col-md-3"></div>
        <div class="col-md-6 jumbotron">
        <h1 style="margin-left: 20%"><i>Doctor Log In</i></h1>
                <form method ="post" class="my-2">
                    <div>
                        <?php
                            if(isset($error['login'])){
                                $sh = $error['login'];
                                $show = '<h6 class ="text-center alert alert-danger ">'.$sh.'</h6>';
                            }else{
                                $show = '';
                            }
                            echo $show;
                        ?>
                    </div>

                    <div class="form-group">
                        <lable><b>Username</b></lable>
                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                    </div>
                    <div class ="form-group">
                        <label><b>Password</b></label>
                        <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div>
                    <input type="submit" name="login" class="btn btn-info my-3" value="Login" style="margin-left:38%;">
                    <p>Don't Have an account? <a href="apply.php">Apply Now!!</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>