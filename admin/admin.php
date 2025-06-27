<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
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
        <h5 class="text-white">Admin Profile</h5>
        <div class="mr-auto"></div>
        <ul class="navbar-nav">
            <?php
                if(isset($_SESSION['admin'])){
                    $user = $_SESSION['admin'];
                    echo '<li class="nav-item"> <a href="#" class="nav-link text-white">'.$user.'</a></li>
                    <li class="nav-item"> <a href="logout.php" class="nav-link text-white">Log Out</a></li>';     
                }
            ?>
           
        </ul>
    </nav>

        <div class = "container-fluid">
            <div class = "col-md-12">
                <div class = "row">
                    <div class="col-md-2" style = "margin-left : -30px;">
                        <?php
                            include("sidenav.php");
                            include("../connection.php");
                        ?>
                    </div>
                    <div class="col-md-10">
                        <div class="col-md-12">
                            <div class = "row">
                                <div class="col-md-6">
                                    <h3 class = "text-center"><i>All Admin</i></h3>

                                    <?php
                                        $ad = $_SESSION['admin'];
                                        $query = "SELECT * FROM admin WHERE username != '$ad'";
                                        $res = mysqli_query($connect, $query);
                                        $output = "
                                        <table class='table table-bordered'>
                                        <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th style='width : 10%;'>Action</th>
                                        </tr>

                                        ";
                                        if(mysqli_num_rows($res)<1){
                                            $output .= "<tr><td colspan='2' class = 'text-center'>No New Admin</td></tr>";
                                        }

                                        while($row = mysqli_fetch_array($res)){
                                            $id = $row['id'];
                                            $username = $row['username'];
                                            $output .= "
                                            <tr>
                                            <td>$id</td>
                                            <td>$username</td>
                                            <td>
                                               <a href= 'admin.php?id=$id'> <button id='$id' class='btn btn-danger'>Remove</button></a>
                                            </td>
                                            
                                            ";
                                        }

                                        $output .= "</tr>

                                        </table>";
                                        echo $output;
                                        if(isset($_GET['id'])){
                                            $id = $_GET['id'];
                                            $query = "DELETE FROM admin WHERE id='$id' ";
                                            $result = mysqli_query($connect, $query);
                                            if (!$result) {
                                                echo "Error: " . mysqli_error($connect);
                                            }
                                        }

                                    ?>   

                                </div>
                                <div class="col-md-6">


                                    <?php
                                        if(isset($_POST['add'])){
                                            $id = $_POST['id'];
                                            $uname = $_POST['uname'];
                                            $pass = $_POST['pass'];
                                            $image = $_FILES['img']['name'];

                                            $error = array();

                                            if(empty($id)){
                                                $error['u'] = "ENTER ID";
                                            }else if(empty($uname)){
                                                $error['u'] = "Enter Username"; 
                                            }else if(empty($pass)){
                                                $error['u'] ="Enter Password";
                                            }else if(empty($image)){
                                                $error['u'] = "Upload Photo";
                                            }

                                            if(count($error)==0){
                                                $q = "INSERT INTO admin (id, username, password, profile) VALUES ('$id','$uname','$pass','$image')";
                                                $result = mysqli_query($connect, $q);
                                                if($result){
                                                    move_uploaded_file($_FILES['img']['tmp_name'],"../img/$image");
                                                }else{
                                                  
                                                }
                                            }
                                        }

                                       

                                    ?>
                                     <h3 class = "text-center"><i>Add Admin</i></h3>
                                     <form method = "post" enctype ="multipart/form-data">
                                        <div>
                                            <?php
                                                if(isset($error['u'])){
                                                    $sh = $error['u'];
                                                    $show = '<h6 class ="text-center alert alert-danger ">'.$sh.'</h6>';
                                                }else{
                                                    $show = "";
                                                }

                                                echo $show;
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label><b>ID Number</b></label>
                                            <input type="text" name="id" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label><b>Username</b></label>
                                            <input type="text" name="uname" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                        <label><b>Password</b></label>
                                            <input type="text" name="pass" class="form-control" autocomplete="off">
                                        </div>
                                        <div class ="form-group">
                                            <label><b>Upload Photo</b></label>
                                            <input type = "file" name="img" class = "form-control">
                                        </div><br>
                                        <input type="submit" name="add" value="Add New Admin" class ="btn btn-success">
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