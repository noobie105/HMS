<?php
session_start();
if(isset($_SESSION['ac'])){
    unset($_SESSION['ac']);
    header("Location: ..\index.php");
}
session_destroy();
?>