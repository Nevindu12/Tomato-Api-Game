<?php
if (isset($_POST['register'])) {

    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    //check if email already exists
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username = '$username'") or die('query failed');

    //if email already exists display error message
    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'User already exists!';
    } else {

        //checking if password and confirm password are matching
        if ($password != $confirmPassword) {
            $message[] = 'Confirm password not matched!';
        } else {

            //if password and confirm password are matching then hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn, "INSERT INTO `users`(fullName, username, age, password) VALUES('$fullName', '$username', '$age', '$hashedPassword')") or die('query failed');
            $message[] = 'Registered successfully!';
            header('location:../View/login.php');
        }
    }
}

// password error notification 

if (isset($message)) {
    foreach ($message as $message) {
        echo '
    <div class="message">
        <span>' . $message . '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
    ';
    }
}
