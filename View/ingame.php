<?php
include '../Controller/config.php';
if (!$_SESSION['loggedIn']) {
    redirect("login.php");
}

if (isset($_GET['new'])) {
    echo '<script>localStorage.removeItem("timeLeft");</script>';
    echo '<script>localStorage.removeItem("score");</script>';
    echo '<script>localStorage.removeItem("numQuestions");</script>';
    echo '<script>localStorage.removeItem("currentLevel");</script>';

    echo '<script>const currentURL = new URL(window.location.href);</script>';
    echo '<script>const searchParams = new URLSearchParams(currentURL.search);</script>';
    echo '<script>searchParams.delete("new");</script>';
    echo '<script>history.replaceState({}, "", ${ currentURL.pathname } ? ${ searchParams.toString() });</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="../Assets/Css/ingame.css">

    <title>MATHZY QUIZ</title>
    <script>
        let timeLeft = localStorage.getItem('timeLeft');
        let score = localStorage.getItem('score') || 0;
        let numQuestions = localStorage.getItem('numQuestions') || 1;
        let currentLevel = localStorage.getItem('currentLevel') || 1;
        let livesLeft = localStorage.getItem('livesLeft');
        let timer;
        let imgApi;
        let solution;
        let timerInterval;

        function updateUI() {
            document.getElementById("question-number").textContent = numQuestions;
            document.getElementById("score").textContent = score;
            document.getElementById("timer").textContent = timeLeft;
            document.getElementById("level-no").textContent = currentLevel;
        }



        function fetchImage() {
            fetch('https://marcconrad.com/uob/tomato/api.php')
                .then(response => response.json())
                .then(data => {
                    imgApi = data.question;
                    solution = data.solution;
                    document.getElementById("imgApi").src = imgApi;

                })
                .catch(error => {
                    console.error('Error fetching image from the API:', error);
                });
        }


        //setting green to correct answer
        function correctAns(ans) {
            ans.css('background-color', '#00E142')
            setTimeout(() => {
                ans.css('background-color', 'rgb(39, 39, 39)')
            }, 1000);
        }
        //setting red to wrong answer
        function wrongAns(ans) {
            ans.css('background-color', 'rgb(255, 43, 43)')
            setTimeout(() => {
                ans.css('background-color', 'rgb(39, 39, 39)')
            }, 1000);
        }
        //updating lives
        function lives() {
            $(".lives").html("<img src='../Assets/Images/heart.gif'>".repeat(livesLeft));
            if (timeLeft == -1) {
                countDown()
            }
        }


        //Game over
        function gameOver() {

            if (livesLeft == 0) {
                var audioElement = document.getElementById("over");
                var audio = document.getElementById("myAudio");
                audio.pause();
                audioElement.play();
                document.getElementById("clock").pause();
                $('.timeTag').removeClass('active');
                $('.gameEnd').css('display', 'flex');
            }
        }


        //Timer Countdown
        function countDown() {
            clearInterval(timerInterval);
            timeLeft = localStorage.getItem('timeLeft');
            timerInterval = setInterval(() => {
                $("#timer").text(timeLeft);

                if (timeLeft <= 10) {
                    $('.timeTag').addClass('active');
                    document.getElementById("clock").play();
                }

                timeLeft -= 1;

                if (timeLeft < 0) {
                    clearInterval(timerInterval);
                    $('.timeTag').removeClass('active');
                    livesLeft -= 1;
                    lives();
                    document.getElementById("wrong").play();
                    document.getElementById("clock").pause();
                    // console.log(livesLeft)
                    fetchImage();
                }
                if (livesLeft == 0) {
                    clearInterval(timerInterval);
                    document.getElementById("clock").pause();
                    gameOver();
                }
            }, 1000);
        }




        //Calculate Score
        function highScore(score) {
            var dataSet = {
                score: score,
                userName: $('#userName').text()
            };

            $.ajax({

                type: 'POST',
                url: '../Controller/scoreHandler.php',
                data: dataSet,
                success: function(response) {

                    if (response === 'Success') {
                        // console.log(response);
                    }
                    console.log(response);
                },
                error: function() {
                    alert('Error occurred. Please try again.');
                }

            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            updateUI();
            fetchImage();
            lives();
        });

        $(document).ready(function() {

            countDown();

            $(".ansBtn").click(function(e) {
                var userAns = $(this).text();
                if (userAns == solution) {
                    correctAns($(this))
                    document.getElementById("correct").play();
                    //document.getElementById("note").innerHTML = 'Correct';
                    score += 10;
                    highScore(score)
                    numQuestions += 1;
                    fetchImage();
                    updateUI();
                    countDown();
                    $('.timeTag').removeClass('active');
                    document.getElementById("clock").pause();
                } else {
                    wrongAns($(this))
                    var audioElement = document.getElementById("wrong");
                    audioElement.currentTime = 0;
                    audioElement.play();

                    livesLeft -= 1;
                    lives();
                    gameOver();
                }
            })

            $('#retry').click(function(e) {
                $('.gameEnd').css('display', 'none');
            })

            //in game audio
            $('#ingame').click(function(e) {
                var audio = document.getElementById("myAudio");

                if (audio.paused) {
                    audio.play();
                    $(this).html("<i class='bi bi-volume-mute'></i>");
                    console.log('play')
                } else {
                    audio.pause();
                    $(this).html("<i class='bi bi-music-note'></i>");
                    console.log('pause')
                }

            })

        })
    </script>
</head>

<body>
    <div class="maincontainer">
        <nav class="navbar">
            <h1 class="logo">MATHZY QUIZ</h1>
            <div class="links">
                <a href="#" id="ingame"><i class="bi bi-volume-mute"></i></a>
                <a href="index.php"><i class="bi bi-house-fill custom-icon"></i></a>
                <a href="../Controller/logout.php"><i class="bi bi-power custom-icon"></i></a>
            </div>
        </nav>

        <div class="container">
            <div class="uTitle">Hi <span id='userName'> <?php echo "" . $_SESSION["user_username"] . ""; ?>
                </span>, LET'S PLAY! </div>

            <div class="game-Data">
                <span>Level <span id="level-no">1</span></span>
                <span>Question<span id="question-number">1</span></span>
                <span>Score<span id="score">0</span></span>
                <span class="timeTag" id='timeTag'>Time(S) <span id="timer">45</span></span>
                <div class="lives"></div>
            </div>
            <div class="imgApi">
                <img src="" alt="Question Image" id="imgApi" class="color-image">
            </div>

            <div class="answers">
                <p class="txtAns" id='ans'>Choose Your Answer : <button class='ansBtn'>0</button>
                    <button class='ansBtn'>1</button>
                    <button class='ansBtn'>2</button>
                    <button class='ansBtn'>3</button>
                    <button class='ansBtn'>4</button>
                    <button class='ansBtn'>5</button>
                    <button class='ansBtn'>6</button>
                    <button class='ansBtn'>7</button>
                    <button class='ansBtn'>8</button>
                    <button class='ansBtn'>9</button>
                </p>
            </div>

            <!-- <div id="note"></div> -->

            <audio id="correct" src="../Assets/Audio/correct.mp3" preload="auto"></audio>
            <audio id="wrong" src="../Assets/Audio/wrong.mp3" preload="auto"></audio>
            <audio id="over" src="../Assets/Audio/over.mp3" preload="auto"></audio>
            <audio id="clock" src="../Assets/Audio/clock.mp3" preload="auto"></audio>
            <audio autoplay loop id="myAudio">
                <source src="../Assets/Audio/ingame.mp3" type="audio/mpeg">
            </audio>


            <div class="gameEnd">
                <div class="over">
                    <p>GAME OVER</p>
                    <a href="" id="retry"><button>Retry</button></a>
                    <a href="./index.php"><button> Home</button></a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>