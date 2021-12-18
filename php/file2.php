<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$errors = array();

// -----------------****  if user clicks signup button  ****-------------------
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);

    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $image = mysqli_real_escape_string($con, $_FILES['photo']['name']);
    $tmp_name = mysqli_real_escape_string($con, $_FILES['photo']['tmp_name']);
    $role = mysqli_real_escape_string($con, $_POST['role']);


    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        move_uploaded_file($tmp_name, "../uploads/$image");
        $insert_data = "INSERT INTO usertable (name, mobile, address, email, password, photo, role, code, status, vstatus, vote)
                        values('$name', '$mobile', '$address', '$email', '$encpass', '$image', '$role', '$code', '$status','0', '0')";
        
        /*
        if($insert_data){
            echo '
                <script>
                    alert("Registration Successful!");
                    window.location = "../";
                </script>
            ';
        }
        else{
            echo '
                <script>
                    alert("Error!!");
                    window.location = "../php/register.html";
                </script>
            ';
        } 
        */

        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: isratishu0209@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }
            else{
                $errors['otp-error'] = "Failed while sending code!"; //sending OTP mail ERROR
            }
        }
        else{
            $errors['db-error'] = "Failed while inserting data into database!"; //database insertion ERROR
        }
    }

}


// -----------------****  if user click verification code submit button  ****-----------------
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }


// ----------------*****  if user click login button  ****-----------------
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        $role = mysqli_real_escape_string($con, $_POST['role']);
        
        $check_email = "SELECT * FROM usertable WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);

        if(mysqli_num_rows($res) > 0){  // email id check
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];

            if(password_verify($password, $fetch_pass)){  // correct password check
                $check_role = "SELECT * FROM usertable WHERE email='$email' AND role = '$role'";
                $chk_role = mysqli_query($con, $check_role);

                if(mysqli_num_rows($chk_role) > 0){  // voting role check

                    /*
                    $check = "SELECT * FROM usertable WHERE email='$email' AND password='$password' AND role = '$role'";
                    $userdata = mysqli_fetch_array($check);
                    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role =2 ");
                    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
                    $_SESSION['userdata'] = $userdata;
                    $_SESSION['groupsdata'] = $groupsdata;
                    */

                    $_SESSION['email'] = $email;
                    $status = $fetch['status'];
    
                    if($status == 'verified'){  // OTP verification check
                      $_SESSION['email'] = $email;
                      $_SESSION['password'] = $password;
                        header('location: home.php');
                    }
          // ------------------------ Error Check --------------------------
                    else{
                        $info = "You haven't verified your email yet - $email";
                        $_SESSION['info'] = $info;
                        header('location: user-otp.php');
                    }
                }

                else{
                    $errors['email'] = "No user found!! Try again.";
                }
            }

            else{
                $errors['email'] = "Incorrect email or password!";
            }
        }

        else{
            $errors['email'] = "You're not a member yet! Please register here.";
        }
    }


// ---------**** if user click continue button in forgot password form ****----------

    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);

        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);

            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: isratishu0209@gmail.com";

                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset code to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }
          // ------------------------ Error Check --------------------------
                else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }

            else{
                $errors['db-error'] = "Something went wrong!";
            }
        }
        
        else{
            $errors['email'] = "This email address does not exist!";
        }
    }


// ----------------****  if user click check reset otp button  ****--------------
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);

        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }

        else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }

    }


// ------------------****  if user click change password button  ****-------------------
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }
        
        else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE usertable SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);

            if($run_query){
                $info = "Your password changed. Login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }

            else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
// ------------**** if user click login-now button after changing password ****----------
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }

?>