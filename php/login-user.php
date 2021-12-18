<?php require_once "controllerUserData.php"; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Login</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="flex-container">

        <div class="flex-item box-1">
            <div class="container">
                <img src="image/login3.png" />
                <form action="#" method="POST" autocomplete="">
                    <h2>Login</h2>

                    <?php
                    if(count($errors) > 0){
                        ?>
                    <div class="alert alert-danger text-center">
                        <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                    </div>
                    <?php
                    }
                    ?>
                    <input type="text" name="st_id" placeholder="Enter student id" required>
                    <i class="fas fa-user" style="color: #777; margin-left: -18.5px;"></i>
                    <br><br>
                    <input type="email" name="email" placeholder="Enter email address" required>
                    <i class="fas fa-at" style="color: #777; margin-left: -18.5px;"></i>
                    <br><br>
                    <input type="password" name="password" id="id_password" placeholder="Enter password" required>
                    <i class=" far fa-eye" id="togglePassword"
                        style="color: #777; left: 2px; margin-left: -18.5px; cursor: pointer;"></i>
                    <br><br>


                    <select id="dropbox" name="dept">
                        <option value="CSE">CSE</option>
                        <option value="EEE">EEE</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="EB">EB</option>
                    </select><br><br>

                    <div class="fpass"><a href="forgot-password.php" style=" color: #079992;"><u>Forgot password?</u></a></div><br>

                    <button class="btn" type="submit" name="login" value="Login">Login Form</button><br><br>
                    <p>New user? <span><a href="signup-user.php" style=" color: #079992;">Register here</a></span>
                    </p>
                </form>

            </div>
        </div>


        <div class="flex-item box-2">
            <div class="sidePart">
                <div id="headerSection">
                    <h1 class="heading">Online <span>Voting System</span></h1>
                </div>
                <img src="image/img1.png" />
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