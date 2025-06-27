<?php
    session_start();
    include "connection.php";
    
    $error = array();
    if(isset($_POST['login'])){
        $username = $_POST['uname'];
        $password = $_POST['pass'];

        
        if(empty($username)){
            $error['ac'] = "Enter Username";
        } else if(empty($password)){
            $error['ac'] = "Enter Password";
        }
    }

    if(isset($_POST['login']) && count($error)==0){
        $query = "SELECT * FROM patient WHERE username = '$username' AND password = '$password' ";
        $result = mysqli_query($connect, $query);
        if(mysqli_num_rows($result)==1){
            echo "<script>alert('You have logged in as an Patient!')</script>";
            $_SESSION ['ac'] = $username;
            header("Location: patient/index.php");
            
        }else{
            echo "<script>alert('Invalid Username or Password!')</script>";
        }
    }
    

?>

<!DOCTYPE html>
<head>
    <title>Patient Login Page</title>
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
        <h1 style="margin-left: 20%"><i>Patient Log In</i></h1>
                <form method ="post" class="my-2">

                    <div>
                        <?php
                            if(isset($error['ac'])){
                                $sh = $error['ac'];
                                $show = '<h6 class ="alert alert-danger ">'.$sh.'</h6>';
                            }else{
                                $show = '';
                            }
                            echo $show;
                        ?>
                    </div>

                    <div class="form-group">
                        <lable><b>Username</b></lable>
                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username"
                        value="<?php if(isset($_POST['uname'])) echo $_POST['uname']; ?>">
                    </div>
                    <div class ="form-group">
                        <label><b>Password</b></label>
                        <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                    </div>
                    <input type="submit" name="login" class="btn btn-info my-3" value="Login" style="margin-left:38%;" >
                    <p>Don't Have an account? <a href="account.php">Create Now!!</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>