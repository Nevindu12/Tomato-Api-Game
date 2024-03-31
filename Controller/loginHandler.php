<?php

//login button click checking
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        //verify the input password with the password column data
        if (password_verify($password, $row['password'])) {

            //set sessions
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_fname'] = $row['fullName'];
            $_SESSION['user_username'] = $row['username'];
            header('location:../View/index.php');
        } else {
            $message[] = 'Incorrect email or password!';
        }
    } else {
        $message[] = 'User not found!';
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
?>