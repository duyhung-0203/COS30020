<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Do Duy Hung" />
    <title>TITLE</title>
</head>

<body>
    <h1>Web Programming - Lab09</h1>
    <p>Enter a number between 1 and 100, then press the Guess button</p>
    <form action="guessinggame.php" method="post">
        <input type="text" name="guessNum" id="guessNum"/>
        <input type="submit" value="Guess" />
    </form>
    <?php
    session_start(); // start the session
    // check if random number has already been generated
    if (!isset($_SESSION["randNum"])) {
        // generate a random number between 1 and 100
        $_SESSION["randNum"] = rand(1, 100);
        // initialize the guess count
        $_SESSION["guess"] = 0;
         // Store the last guess for displaying in the input field
    }

    // check if user has submitted a guess
    if (isset($_POST["guessNum"])) {
        if (is_numeric($_POST["guessNum"]) && floor($_POST["guessNum"]) == $_POST["guessNum"] && !empty($_POST["guessNum"]) && $_POST["guessNum"] >= 1 && $_POST["guessNum"] <= 100) {
            $guess = (int)$_POST["guessNum"]; // Cast to integer to ensure consistency
            $guess = $_POST["guessNum"];
            $_SESSION["guess"]++;

            // Compare guess to random number
            if ($guess < $_SESSION["randNum"])
                echo "<p style='color: red'>Guess higher!</p>";
            else if ($guess > $_SESSION["randNum"])
                echo "<p style='color: red'>Guess lower!</p>";
            else
                echo "<p style='color:green'>Congratulations! You guessed the hidden numer.</p>";
        } else {
            $_SESSION["guess"]++;
            echo "<p style='color:red'>You must enter a positive number between 1 and 100!</p>";
        }
    } else {
        echo "<p>Start guessing.</p>";
    }
    ?>
    <p>Number of guess: <?php echo $_SESSION["guess"] ?></p>
    <p><a href="giveup.php">Give Up</a></p>
    <p><a href="startover.php">Start Over</a></p>
</body>

</html>