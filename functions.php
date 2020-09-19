<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'studentinfosys') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$fname = "";
$lname = "";
$email = "";
$password = "";
$error = 0;


if (isset($_POST['adminSignupBtn'])) {
    adminRegister();
}

if (isset($_POST['studentSignupBtn'])) {
    studentRegister();
}

if (isset($_POST['adminLoginBtn'])) {
    adminLogin();
}

if (isset($_POST['studentLoginBtn'])) {
    studentLogin();
}


if (isset($_GET['admin_logout'])) {
    session_destroy();
    mysqli_close($conn);
    header("location: admin_login.php");
}

if (isset($_GET['student_logout'])) {
    session_destroy();
    mysqli_close($conn);
    header("location: student_login.php");
}


if (isset($_GET['delete'])) {
    $student_id = $_GET['delete'];

    $mysqli->query("DELETE FROM student WHERE student_id=$student_id") or
        die($mysqli->error);

    $_SESSION['message'] = "Student record has been deleted!";
    $_SESSION['msg_type'] = "warning";

    header("location: admin_dashboard.php");
}

if (isset($_GET['edit'])) {
    $student_id = $_GET['edit'];
    $update = 'true';
    $result = $mysqli->query("SELECT * FROM student WHERE student_id=$student_id") or
        die($mysqli->error);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $_SESSION['student_id'] = $row['student_id'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['age'] = $row['age'];
        $_SESSION['course'] = $row['course'];
    }
}

if (isset($_POST['adminUpdateBtn'])) {
    adminUpdate();
}

if (isset($_POST['studentUpdateBtn'])) {
    studentUpdate();
}


//Register Admin User
function adminRegister() {
    global $mysqli, $error;

    $fname    =  $_POST['fname'];
    $lname    =  $_POST['lname'];
    $email    =  $_POST['email'];
    $password =  $_POST['password'];

    if (empty($fname)) {
        $error = 1;
    }
    if (empty($lname)) {
        $error = 1;
    }
    if (empty($email)) {
        $error = 1;
    }
    if (empty($password)) {
        $error = 1;
    }
    // if ($password_1 != $password_2) {
    // 	$error = 1;
    // }

    $result = $mysqli->query("SELECT * FROM admin WHERE email='$email'") or
        die($mysqli->error);

    if (($result->num_rows) > 0) {
        $row = $result->fetch_assoc();
        if ($email == $row['email']) {
            $error = 1;
            $_SESSION['message'] = "Email already exists! Try again.";
            $_SESSION['msg_type']  = "danger";
            header("location: admin_registration.php");
            mysqli_close($mysqli);
        }
    }

    if (empty($error)) {
        $password_e = md5($password);

        $mysqli->query("INSERT INTO admin (fname, lname, email, password) VALUES('$fname', '$lname', '$email', '$password_e')") or
            die($mysqli->error);

        $_SESSION['message'] = "Registration successful. You may now login.";
        $_SESSION['msg_type']  = "success";
        header("location: admin_login.php");
    }
}


//Register Student User
function studentRegister() {
    global $mysqli, $error;

    $fname    =  $_POST['fname'];
    $lname    =  $_POST['lname'];
    $age      =  $_POST['age'];
    $course   =  $_POST['course'];
    $email    =  $_POST['email'];
    $password =  $_POST['password'];


    if (empty($fname)) {
        $error = 1;
    }
    if (empty($lname)) {
        $error = 1;
    }
    if (empty($age)) {
        $error = 1;
    }
    if (empty($course)) {
        $error = 1;
    }
    if (empty($email)) {
        $error = 1;
    }
    if (empty($password)) {
        $error = 1;
    }
    // if ($password_1 != $password_2) {
    // 	$error = 1; 
    // }


    $result = $mysqli->query("SELECT * FROM student WHERE email='$email'") or
        die($mysqli->error);

    if (($result->num_rows) > 0) {
        $row = $result->fetch_assoc();
        if ($email == $row['email']) {
            $error = 1;
            $_SESSION['message'] = "Email already exists!";
            $_SESSION['msg_type'] = "danger";
            header("location: student_registration.php");
            mysqli_close($mysqli);
        }
    }


    if (empty($error)) {
        $password_e = md5($password);

        $mysqli->query("INSERT INTO student (fname, lname, age, course, email, password) VALUES('$fname', '$lname', $age, '$course', '$email', '$password_e')") or
            die($mysqli->error);

        $_SESSION['message'] = "Registration successful. You may now login.";
        $_SESSION['msg_type'] = "success";
        header("location: student_login.php");
    }
}


//Login Admin User
function adminLogin() {
    global $mysqli, $email, $error;

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $error = 1;
    }
    if (empty($password)) {
        $error = 1;
    }

    if (empty($error)) {
        $password_e = md5($password);

        $result = $mysqli->query("SELECT * FROM admin WHERE email = '$email' AND password='$password_e'") or die($mysqli->error);

        if (($result->num_rows) > 0) {

            $row = $result->fetch_assoc();

            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];

            header("location: admin_dashboard.php");
        }
        
        else {
            $_SESSION['message']  = "Wrong email or password combination";
            $_SESSION['msg_type']  = "danger";
            header("location: admin_login.php");

        } 
    }
}


//Login Student User
function studentLogin() {
    global $mysqli, $email, $error;

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $error = 1;
    }
    if (empty($password)) {
        $error = 1;
    }

    if (empty($error)) {
        $password_e = md5($password);

        $result = $mysqli->query("SELECT * FROM student WHERE email = '$email' AND password='$password_e'") or die($mysqli->error);

        if (($result->num_rows) > 0) {

            $row = $result->fetch_assoc();

            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];

            header("location: student_dashboard.php");
        }

        else {
            $_SESSION['message']  = "Wrong email or password combination";
            $_SESSION['msg_type']  = "danger";
            header("location: student_login.php");

        } 
    }
}


function adminUpdate() {
    global $mysqli, $email, $error;

    $student_id   =  $_POST['student_id'];
    $fname        =  $_POST['fname'];
    $lname        =  $_POST['lname'];
    $age          =  $_POST['age'];
    $course       =  $_POST['course'];
    
    if (empty($fname)) {
        $error = 1;
    }
    if (empty($lname)) {
        $error = 1;
    }
    if (empty($age)) {
        $error = 1;
    }
    if (empty($course)) {
        $error = 1;
    }

    if (empty($error)) {
   $mysqli->query("UPDATE student SET fname = '$fname', lname = '$lname', age = $age, course = '$course' WHERE student_id = $student_id") 
   or die($mysqli->error);
   

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "success";

    header("location: admin_dashboard.php");

    } else {
        $_SESSION['message'] = "An error has occured. Please try again.";
        header("location: admin_student_profile_edit.php");
    }
}

function studentUpdate() {
    global $mysqli, $email, $error;

    $student_id   =  $_POST['student_id'];
    $fname        =  $_POST['fname'];
    $lname        =  $_POST['lname'];
    $age          =  $_POST['age'];
    $course       =  $_POST['course'];
    
    if (empty($fname)) {
        $error = 1;
    }
    if (empty($lname)) {
        $error = 1;
    }
    if (empty($age)) {
        $error = 1;
    }
    if (empty($course)) {
        $error = 1;
    }

    if (empty($error)) {
   $mysqli->query("UPDATE student SET fname = '$fname', lname = '$lname', age = $age, course = '$course' WHERE student_id = $student_id") 
   or die($mysqli->error);
   

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "success";

    header("location: student_dashboard.php");

    } else {
        $_SESSION['message'] = "An error has occured. Please try again";
        header("location: student_profile_edit.php");
    }
}