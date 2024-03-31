<?php
include '../Controller/config.php';
if(!$_SESSION['loggedIn']){
    redirect("login.php");
}
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
    <link rel="stylesheet" href="../Assets/Css/index.css" type="text/css">

    <title>MATHZY QUIZ</title>
</head>

<body>

    <nav class="navbar">
        <h1 class="logo">MATHZY QUIZ</h1>
        <div class="links">
            <?php if($_SESSION['loggedIn']){ ?>
                <a href="profile.php">Hi, <?=$_SESSION['user_username'];?></a>
            <?php } ?>
            <a href="scores.php"><i class="bi bi-trophy-fill"></i></a>
            <a href="../Controller/logout.php"><i class="bi bi-power custom-icon"></i></a>
        </div>
    </nav>
    <div class="container">
        <div class="content">
            <h1 class="mainTitle">Let's Play</h1>
            <img id="image" src="../Assets/Images/main_img.png" alt="">
            <?php if($_SESSION['loggedIn']){ ?>
                <a href="howtoplay.php"><button class="howtoplayBtn" id="startbtn">How To Play</button></a>
            <?php } ?>    
            <a href="sample.html"><button class="startBtn" id="startbtn">Start Playing</button></a>
        </div>
    </div>

</body>

</html>