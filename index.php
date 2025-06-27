<!DOCTYPE html>
<head>
    <title>HMS Home Page</title>
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
            background-color: rgba(0, 0.5, 0.5, 0.0);
            backdrop-filter: blur(10px); /* Apply a blur effect */
            z-index: -1; /* Place behind other content */
        }
        
        
    </style>
</head>
<body>
    <div class="blur-overlay"></div>
    <?php
    include ("header.php");
    ?>
    <div style="margin-top: 50px"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 mx-3 shadow" style="background-color: aliceblue;">
                    <img src="img/more_info.jpg" style="width: 100%;">
                    <h5 class="text-center" style="margin-top: 0%;">Learn More About Us</h5>
                    <a href="more.php">
                        <button class="btn btn-info my-3" style="margin-left:25%;">Click Here</button>
                    </a>

                </div>

                <div class="col-md-3 mx-3 shadow" style="background-color: aliceblue;">
                    <img src="img/patient.jpeg" style="width: 100%; height: cover;">
                    <h5 class="text-center" style="margin-top: 5%;">Create Account as Patient</h5>
                    <a href="account.php">
                        <button class="btn btn-info my-3" style="margin-left:25%;">Create Account</button>
                    </a>

                </div>

                <div class="col-md-3 mx-3 shadow" style="background-color: aliceblue;">
                    <img src="img/doctor.jpeg" style="width: 100%;">
                    <h5 class="text-center">Want to Work as a Doctor</h5>
                    <a href="apply.php">
                        <button class="btn btn-info my-3" style="margin-left:25%;">Apply Now</button>
                    </a>

                </div>

            </div>
             
        </div>
    </div>
</body>