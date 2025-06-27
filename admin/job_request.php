<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Job Applications</title>
        
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
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2" style = "margin-left : -30px;">
                        <?php
                            include("sidenav.php");
                        ?>
                    </div>
                    <div class="col-md-10">
                    <h3 class="text-center"><b><i>Job Applications</i></b></h3>
                        <div id="show"></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                show();
                function show(){
                    $.ajax({
                        url:"ajax_job_request.php",
                        method:"POST",
                        success:function(data){
                            $("#show").html(data);
                        }
                    });
                }

                $(document).on('click','.approve',function(){
                    var id = $(this).attr("id");
                    $.ajax({
                        url:"ajax_approve.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            show();
                        }
                    });
                });

                $(document).on('click','.reject',function(){
                    var id = $(this).attr("id");
                    $.ajax({
                        url:"ajax_reject.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data){
                            show();
                        }
                    });
                });

            });
        </script>
    </body>
</html>