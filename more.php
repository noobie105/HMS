
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
            p{
                text-align: center;
                color: white;
                font-size: large;
            }
        </style>
    </head>
    <body>
       <div class="blur-overlay"></div>
       <?php include("header.php"); ?>
       <br><br><br>
       <h4 class="text-center" style="color: white;"><b><i><u>About Us</u></i></b></h4>
       <p>
        Evercare Hospital Dhaka is a multidisciplinary super specialty tertiary care hospital in Dhaka, Bangladesh and part of <br>Evercare Group. 
        It was previously calledApollo Hospital Dhaka. The hospital is located in Bashundhara Residential Area.
    </p>
    <br>
    <h4 class="text-center" style="color: white;"><b><i><u>Contact Us</u></i></b></h4>
    <p>
        Mobile : +088123456789<br>
        Email : evercare@gmail.com
    </p>
    <br>
    <h4 class="text-center" style="color: white;"><b><i><u>Developed By</u></i></b></h4>
    <p>
        Alifa Shanzidah Manarat.<br>
        Roll : 1903105<br>
    </p>
    <br>
    <h4 class="text-center" style="color: white;"><b><i><u>Submitted To</u></i></b></h4>
    <p>
        Shyla Afroge,<br>
        Assistant Professor,<br>
        Dept. of CSE, RUET.
    </p>
    </body>
</html>