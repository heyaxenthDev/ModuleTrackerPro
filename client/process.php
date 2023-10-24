<?php
session_start();

include 'includes/conn.php';

if (isset($_POST['SaveChanges'])) {

    $id = filter_input(INPUT_POST, 'id');
    $schoolID = filter_input(INPUT_POST, 'schoolID');
    $fname = filter_input(INPUT_POST, 'FirstName');
    $mname = filter_input(INPUT_POST, 'MiddleName');
    $lname = filter_input(INPUT_POST, 'LastName');
    $course = filter_input(INPUT_POST, 'course');
    $yearlvl = filter_input(INPUT_POST, 'yearlvl');
    $section = filter_input(INPUT_POST, 'section');
    $email = filter_input(INPUT_POST, 'email');

    $sql = ("UPDATE `client` SET `schoolID`='$schoolID',`firstname`='$fname',`lastname`='$lname',`middlename`='$mname',`email`='$email',`course`='$course',`yearlevel`='$yearlvl',`section`='$section' WHERE `id`='$id'");
    if($conn->query($sql)){
        $_SESSION['status'] = "Profile Updated!";
        $_SESSION['status_text'] = " ";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_btn'] = "Done";
        header("Location:user-profile.php");
        exit (0);
    }
    else{
        $_SESSION['status'] = "Profile cannot be Updated!";
        $_SESSION['status_text'] = " ";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Back";
        header("Location:user-profile.php");
    }
}

if (isset($_POST['changePassword'])) {

    $id = filter_input(INPUT_POST, 'id'); 
    $currentPassword = filter_input(INPUT_POST, 'currentPassword');
    $newPassword = filter_input(INPUT_POST, 'newPassword');
    $renewPassword = filter_input(INPUT_POST, 'renewPassword');

    $sql_check = ("SELECT * FROM client WHERE `password` = '$currentPassword' AND `id` = '$id'");
    if($conn->query($sql_check)){
        $sql_update = ("UPDATE `client` SET `password`='$newPassword' WHERE `id` = '$id'");
        if ($conn->query($sql_update)) {
            $_SESSION['status'] = "Password Changed!";
            $_SESSION['status_text'] = " ";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_btn'] = "Done";
            header("Location:user-profile.php");
            exit (0);
        }else{
            $_SESSION['status'] = "Password cannot be Changed!";
            $_SESSION['status_text'] = " ";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "Back";
            header("Location:user-profile.php");
        }
    }
    else{
        $_SESSION['status'] = "Password cannot be Changed!";
        $_SESSION['status_text'] = " ";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Back";
        header("Location:user-profile.php");
    }
    

}

?>