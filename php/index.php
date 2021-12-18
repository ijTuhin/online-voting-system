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
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>
    <div class="flex-container">

        
    <div class="flex-item box-1"> 
            <div class="container">
                <p>Which Student Database <br>You Belong?</p> 
                <form action="signup-user.php" method="POST" autocomplete="">
                    <!--
                <?php
                   /* if(count($errors) == 1){
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
                    } */
                    ?> -->


                    <input type="submit" name="male_btn" value="Male" class="m_btn">
                    <input type="submit" name="female_btn" value="Female" class="f_btn">        
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