<?php require_once "controllerUserData.php"; ?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System - Registration</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/register.css">

</head>

<body>
    <style>

    </style>
    <div class="flex-container">

        <div class="flex-item box-1">
            <div class="container">
                <img src="image/login.png" />
                <h2>Registration</h2>
                <form action="signup-user.php" method="POST" enctype="multipart/form-data" autocomplete="">

                <?php
                    if(count($errors) == 1){
                        ?>
                    <div class="alert alert-danger text-center">
                        <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                    </div>
                    <?php
                    }elseif(count($errors) > 1){
                        ?>
                    <div class="alert alert-danger">
                        <?php
                            foreach($errors as $showerror){
                                ?>
                        <li>
                            <?php echo $showerror; ?>
                        </li>
                        <?php
                            }
                            ?>
                    </div>
                    <?php
                    }
                    ?>

                    <input type="text" name="name" placeholder="Enter name" required="<?php echo $name ?>">
                    <input type="text" name="st_id" placeholder="Enter student id" required><br><br>
                    <input id="emailID" type="email" name="email" placeholder="Enter email address" required="<?php echo $email ?>"><br><br>                             
                    <input type="tel" name="mobile" placeholder="Enter mobile" required>
                    <input type="text" name="address" placeholder="Address"><br><br>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="cpassword" placeholder="Confirm Password" required><br><br>
                    <center>
                        <div id="imgpart">
                            <p>Upload image:<input type="file" name="photo" class="box" required></p>
                        </div>
                        <br>
                        <div id="role">
                            <p>
                                <select name="dept" class="voter">
                                <option value="0" disabled >Choose Your Department</option>
                                <option value="CSE">CSE</option>
                                <option value="EEE">EEE</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="EB">EB</option>
                                </select>
                            </p>
                    </div>
                        <br>
                    </center>
                    <button class="btn" type="submit" name="signup" value="Signup">Register Now</button><br><br>
                    <p>Already user? <span><a href="login-user.php" style=" color: #079992;">Login here</a></span></p>
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