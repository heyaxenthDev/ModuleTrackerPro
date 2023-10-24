<?php
session_start();

include('admin/includes/conn.php');

if(isset($_SESSION['client_auth'])){

    $_SESSION['status'] = "Logged Out Successfully!";
    $_SESSION['status_text'] = "You have been logged out.";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_btn'] = "Done";

    unset($_SESSION['client_auth']);
    unset($_SESSION['user_details']);
    header("Location: index");
    exit(0);
}

if(isset($_SESSION['admin_auth'])){

    $_SESSION['status'] = "Logged Out Successfully!";
    $_SESSION['status_text'] = "You have been logged out.";
    $_SESSION['status_code'] = "success";
    $_SESSION['status_btn'] = "Done";

    unset($_SESSION['admin_auth']);
    unset($_SESSION['user_details']);
    header("Location: index");
    exit(0);
}


?>