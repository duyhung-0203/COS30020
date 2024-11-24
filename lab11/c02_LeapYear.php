<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Web application development"/>
    <meta name="keywords" content="PHP"/>
    <meta name="author" content="Do Duy Hung"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Leap Year</title>

</head>
<body>
<?php
if (isset($_GET['year'])) {
    $Year = $_GET["year"];
    if (is_numeric($Year) && $Year > 0 && $Year == round($Year)) {
        if ($Year % 4 != 0)
            echo "The year you entered is a standard year.";
        elseif ($Year % 400 == 0)
            echo "The year you entered is a leap year.";
        elseif ($Year % 100 == 0)
            echo "The year you entered is a standard year.";
        else
            echo "The year you entered is a leap year.";
    } else {
        echo "Please enter a positive integer value.";
    }
} else {
    echo "Please enter a year";
}
?>
</body>
</html>
