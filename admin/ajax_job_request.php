<?php
include("../connection.php");

$query = "SELECT * FROM doctors WHERE status='Pending' ORDER BY data_reg ASC";
$res = mysqli_query($connect,$query);
$output ="";
$output .= "

    <table class = 'table table-bordered'>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Medical College</th>
        <th> Educational details</th>
        <th>Experience</th>
        <th>Action</th>
    </tr>

";
if(mysqli_num_rows($res)<1){
    $output .= "
    <tr>
        <td colspan='10' class='text-center'>No job application at this moment.</td>
    </tr>
    ";
}

while($row = mysqli_fetch_array($res)){
    $output .= "
    <tr>
        <td>".$row['id']."</td>
        <td>".$row['first_name']."</td>
        <td>".$row['last_name']."</td>
        <td>".$row['username']."</td>
        <td>".$row['email']."</td>
        <td>".$row['gender']."</td>
        <td>".$row['medical_college']."</td>
        <td>".$row['education']."</td>
        <td>".$row['experience']."</td>
        <td>
            <div class='col-md-12'>
                <div class='row'>
                    <div class='col-md-10'>
                        <button id='".$row['id']."' class='btn btn-success approve'>Approve</button>
                    </div>
                    <div class='col-md-10 my-2'>
                        <button id='".$row['id']."' class='btn btn-danger reject'>Reject</button>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    ";
}

$output .="</table>";
echo $output;

?>