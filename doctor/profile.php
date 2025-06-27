<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Doctor's Profile</title>
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
        <h5 class="text-white">Doctor's Profile</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['doctor'])){
                    $doc = $_SESSION['doctor'];
                    echo '<li class="nav-item"> <a href="#" class="nav-link text-white">'.$doc.'</a></li>
                    <li class="nav-item"> <a href="logout.php" class="nav-link text-white">Log Out</a></li>';     
                }
            ?>
           
        </ul>
    </nav>

    <?php 
        
        include("../connection.php");
        $doc = $_SESSION['doctor'];
        $query = "SELECT * FROM doctors WHERE username='$doc'";
        $res = mysqli_query($connect, $query);
        while($row = mysqli_fetch_array($res)){
            $username = $row['username'];
            $profile = $row['profile'];
        }
    
    ?>

    <div class = "container-fluid">
        <div class = "col-md-12">
            <div class = "row">
                <div class="col-md-2" style = "margin-left : -30px;">
                    <?php
                        include("sidenav.php");
                    ?>
                </div>
                <div class = "col-md-10">
                    <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4> Profile of <?php echo $username;?> </h4>

                                <?php 
                                    if(isset($_POST['update'])){
                                        $profile = $_FILES['profile']['name'];
                                        if(empty($profile)){

                                        }else{
                                            $query = "UPDATE doctors SET profile = '$profile' WHERE username = '$doc'";
                                            $result = mysqli_query($connect, $query);
                                            if($result){
                                                move_uploaded_file($_FILES['profile']['tmp_name'],"../img/profile");
                                                $sh = "Photo Updated Successfully!";
                                                $show = '<h6 class ="text-center alert alert-success ">'.$sh.'</h6>';
                                                echo $show;
                                            }

                                        }
                                    }
                                ?>
                                
                                <form method="POST">
                                    <?php 
                                        echo "<img src='img/$profile' class='col-md-6' style='height : 350px;' class='col-md-12' my-3>";
                                    ?>
                                     <br><br>
                                     <div class = "form-group">
                                        <label><b>Update Photo</b></label>
                                        <input type="file" name="profile" class="form-control">   
                                     </div>
                                     
                                     <input type="submit" name="update" value="Update" class="btn btn-success">
                                </form>
                            </div>

                            <div class="col-md-6">

                                <?php 
                                    if(isset($_POST['change'])){
                                        $uname = $_POST['uname'];
                                        if(empty($uname)){

                                        }else{
                                            $q = "UPDATE doctors SET username = '$uname' WHERE username ='$doc'";
                                            $res = mysqli_query($connect, $q);
                                            if($res){
                                                $_SESSION['doctor'] = $uname;
                                            }else{
                                            }
                                        }
                                    }
                                ?>
                                <form method="POST">
                                    <h5 class="text-center my-4"><b>Change Username</b></h5>
                                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Change Username">
                                    <br>
                                    <input type="submit" name="change" value="Change" class="btn btn-success">
                                </form>
                                <br><br>
                                
                                <?php

                                    if(isset($_POST['update_pass'])){
                                        $old_pass = $_POST['old_pass'];
                                        $new_pass = $_POST['new_pass'];
                                        $con_pass = $_POST['con_pass'];

                                        $error = array();

                                        $old = mysqli_query($connect, "SELECT * FROM doctors WHERE username='$doc'");
                                        $row = mysqli_fetch_array($old);
                                        $pass = $row['password'];

                                        if(empty($old_pass)){
                                            $error['p'] = "Enter Old Password";
                                        }else if(empty($new_pass)){
                                            $error['p'] = "Enter New Password";
                                        }else if(empty($con_pass)){
                                            $error['p'] = "Please Confirm Password";
                                        }else if($old_pass != $pass){
                                            $error['p'] = "Incorrect Old Password!";
                                        }else if($new_pass != $con_pass){
                                            $error['p'] = "Confirmation Password Doesn't Match!";
                                        }

                                        if(count($error)==0){
                                            $query2 = "UPDATE doctors SET password='$new_pass' WHERE username='$doc'";
                                            $res = mysqli_query($connect, $query2);

                                            if($res){
                                                echo "<h6 class ='text-center alert alert-success'>Password Updated Successfully!</h6>";
                                            }
                                        } 
                                    }
                                ?>

                                <form method="POST">
                                    <h5 class="text-center my-4"><b>Update Password</b></h5>
                                    <div>
                                        <?php
                                            if(isset($error['p'])){
                                                $sh = $error['p'];
                                                $show = '<h6 class ="text-center alert alert-danger ">'.$sh.'</h6>';
                                                echo $show; 
                                            } 
                                           
                                        ?>
                                    </div>
                                    <div class="form-group">
                                         <label><b>Old Password</b></label>
                                        <input type="password" name="old_pass" class="form-control" placeholder="Enter Old Password">
                                    </div>
                                    <div class="form-group">
                                         <label><b>New Password</b></label>
                                        <input type="password" name="new_pass" class="form-control"placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group">
                                         <label><b>Confirm Password</b></label>
                                        <input type="password" name="con_pass" class="form-control" placeholder="Re-enter New Password">
                                    </div>
                                    <input type="submit" name="update_pass" value="Confirm  Update" class="btn btn-danger">
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </body>
</html>