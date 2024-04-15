<?php

include('./config.php');

$userName = trim($_POST['userName']);
$score = $_POST['score'];

$sql = "SELECT score FROM users WHERE username= '". $userName ."'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$currScore = $row['score'];

if($currScore < $score){
    $sql1 = "UPDATE users SET score = '.$score.' WHERE username= '".$userName."'";

    if(mysqli_query($conn, $sql1)){

        echo "Success";
    }
    else{
        echo "Error";
    }
}
else {
    echo "Lower";
}

?>