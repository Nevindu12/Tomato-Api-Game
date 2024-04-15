<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Score</title>
    <link rel="shortcut icon" href="../Photos/icon.ico" />
    <link rel="stylesheet" href="../Assets/Css/score.css">
</head>

<body>
    <div class="video-container">
        <video autoplay muted loop>
            <source src="../Assets/Video/fireworks.mp4" type="video/mp4">
        </video>

        <div class="content">
            <p>Top 10 High Score</p>
            <div class="table">
                <table>
                    <th><b>User Name</b></th>
                    <th><b>Score</b></th>

                    <?php

            include ('../Controller/config.php');

            $sql = "SELECT * FROM users ORDER BY score DESC LIMIT 10;";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

                    echo "
                        <tr>
                            <td>".$row['username']."</td>
                            <td>".$row['score']."</td>
                        </tr>                        
                        ";
                }

            }

            ?>


                </table>
            </div>

            <a href="./index.php"><button>Back</button></a>
        </div>
    </div>

</body>

</html>