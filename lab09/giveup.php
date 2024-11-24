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
    <p style="color: blue">The hidden number was
        <?php
        session_start(); // start the session
        if (isset($_SESSION["randNum"])) {
            echo $_SESSION["randNum"];
        } else {
            // echo phpversion();
            echo "not generated yet";
        }
        ?>
    </p>
    <p><a href="startover.php">Start Over</a></p>
</body>

</html>