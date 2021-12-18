<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
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
    <link rel="stylesheet" href="../css/mbox.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="login-user.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-now" value="Login Now">
                    </div>
                </form>
            </div>
        </div>
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