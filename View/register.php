<?php
include '../Controller/config.php';
include '../Controller/registerHandler.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Css/register.css" type="text/css">
    <title>MATHZY QUIZ</title>
</head>

<body>
    <div class="container">
        <div class="regform-wrapper">
            <h1 class="heading">Create Your Profile</h1>
            <h3 class="text">MATHZY QUIZ</h3>
            <form class="regform-align" action="" method="post">
                <div class="regform-group">
                    <!-- <label for="fullName">Full Name :</i></label> -->
                    <input type="text" class="input-field" id="fullName" name="fullName" placeholder="Enter Full Name"
                        required>
                </div>
                <div class="regform-group">
                    <!-- <label for="email">Email Address :</i></label> -->
                    <input type="text" class="input-field" id="username" name="username" placeholder="Enter User Name" required>
                </div>
                <div class="regform-group">
                    <!-- <label for="age">Age :</i></label> -->
                    <input type="number" class="input-field" id="age" name="age" placeholder="Enter your age" min="0"
                        required>
                </div>
                <div class="regform-group">
                    <!-- <label for="password">Password :</i></label> -->
                    <input type="password" class="input-field" id="password" name="password"
                        placeholder="Enter password" required>
                </div>
                <div class="regform-group">
                    <!-- <label for="confirmPassword">Confirm Password :</i></label> -->
                    <input type="password" class="input-field" id="confirmPassword" name="confirmPassword"
                        placeholder="Confirm your password" required>
                </div>
                <div class="text-center">
                    <button class="cancelbtn" type="reset" id="cancelbtn">Reset</button>
                    <button class="regformBtn" type="submit" id="regbtn" name="register">Register</button> <br><br>
                    Already Have An Acconut ? <a href="login.php" id="loginlink">Click Here</a>


                </div>
            </form>
        </div>
    </div>

</body>

</html>