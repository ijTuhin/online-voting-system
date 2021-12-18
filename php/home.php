<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Home Page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">

    <style>
    h1{
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        text-align: center;
        transform: translate(-50%, -50%);
        font-size: 50px;
        font-weight: 600;
    }
    </style>

</head>

<body>
    <div class="flex-container">
    
    <button type="button" class="logout" style=" margin-top: 11px;
                padding: 10px; 
                border-radius: 15px;
                background-color: #079992;
                color: white;
                border-radius: 5px;">
                <a href="logout-user.php">Logout</a></button>

    <h1>Welcome <?php echo $fetch_info['name'] ?></h1>
    </div>




    <!-- theme toggler  -->

    <div id="theme-toggler" class="fas fa-moon"></div>

    <!-- custom js file link  -->
    <script src="../js/script.js"></script>

    <script>


        if (localStorage.getItem('active')) {
            document.body.classList.add('active');
        }
        else {
            document.body.classList.remove('active');
        }

    </script>
</body>

</html>