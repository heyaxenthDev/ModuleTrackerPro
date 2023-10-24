<?php
session_start();

include 'admin/includes/conn.php';


//Registration Process
if (isset($_POST['registerBtn'])) {
    
    $schoolID = filter_input(INPUT_POST, 'schoolID');
    $fname = filter_input(INPUT_POST, 'FirstName');
    $mname = filter_input(INPUT_POST, 'MiddleName');
    $lname = filter_input(INPUT_POST, 'LastName');
    $course = filter_input(INPUT_POST, 'course');
    $yearlvl = filter_input(INPUT_POST, 'yearlvl');
    $section = filter_input(INPUT_POST, 'section');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $cpassword = filter_input(INPUT_POST, 'Cpassword');

    $check_data = "SELECT * FROM `client` WHERE `schoolID`='$schoolID' AND `firstname`='$fname' AND `middlename`='$mname' AND `lastname`='$lname' AND `course`='$course' AND `yearlevel`='$yearlvl' AND `section`='$section' LIMIT 1";
    $check_data_run = mysqli_query($conn, $check_data);

    if (mysqli_num_rows($check_data_run) > 0) {

        $_SESSION['status'] = "Data Already Exists!";
        $_SESSION['status_text'] = "Duplicate Data not Accepted.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Try Again";
        header("Location: index.php");
    }else {
        $check_email = "SELECT * FROM `client` WHERE `email`='$email' LIMIT 1";
        $check_email_run = mysqli_query($conn, $check_email);

        if (mysqli_num_rows($check_email_run) > 0) {
            $_SESSION['status'] = "Email Already Exists!";
            $_SESSION['status_text'] = "Please try again with a different Email Address";
            $_SESSION['status_code'] = "warning";
            header("Location: index.php");
        }else {
            if ($password == $cpassword) {
                $query = "INSERT INTO `client`(`schoolID`, `firstname`, `middlename`, `lastname`, `course`, `Password`, `yearlevel`, `email`, `section`) VALUES ('$schoolID','$fname','$mname','$lname','$course','$password','$yearlvl','$email','$section')";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    $_SESSION['status'] = "Registered Successfully!";
                    $_SESSION['status_text'] = "Your account is Ready for Log in";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_btn'] = "Done";
                    header("Location: index.php");
                    exit (0);
                } else {
                    $_SESSION['status'] = "Registration Unsuccessful!";
                    $_SESSION['status_text'] = "Data cannot be Registered! Please check you details again.";
                    $_SESSION['status_code'] = "error";
                    $_SESSION['status_btn'] = "OK";
                    header("Location: index.php");
                }
            } else {
                $_SESSION['status_text'] = "Password and Confirm Password do not match.";
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
                header("Location: index.php");
            }
        }
    }

} 

//Log in Process for Admin
if (isset($_POST['adminLogin'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run)> 0) {
        $_SESSION['admin_auth'] = TRUE;
        $row = mysqli_fetch_array($login_query_run);

        $_SESSION['admin'] = [
            'name' => $row['Name'],
          ];
        $_SESSION['logged'] = "Logged in successfully";
        $_SESSION['logged_icon'] = "success";
        header("Location: admin/dashboard.php");
    }else {
        $_SESSION['set'] = "show";
        $_SESSION['id'] = $email;
        $_SESSION['status'] = "Wrong Username or Password";
        $_SESSION['status_text'] = "Please check your credentials.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: index.php");
    }
}


//Log in Process for Student
if (isset($_POST['studentLogin'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM `client` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1";
    $login_query_run = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($login_query_run)> 0) {
        $_SESSION['client_auth'] = TRUE;

        $row = mysqli_fetch_array($login_query_run);

        $_SESSION['user_details'] = [
            'Lname' => $row['lastname'],
            'Fname' => $row['firstname'],
            'course' => $row['course'],
            'id' => $row['id']

          ];

        $_SESSION['logged'] = "Logged in successfully";
        $_SESSION['logged_icon'] = "success";
        header("Location: client/dashboard.php");
    }else {
        $_SESSION['student_set'] = "show";
        $_SESSION['student_id'] = $email;
        $_SESSION['status'] = "Wrong Username or Password";
        $_SESSION['status_text'] = "Please check your credentials.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: index.php");
    }
}

?>