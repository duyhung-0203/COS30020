<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Lab 1" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" author="Do Duy Hung" />
    <title>Document</title>
</head>

<body>
    <h1>Lab03 Task 3 - Prime Number</h1>
    <hr>

    <?php
    function isPrime($number)
    {
        if ($number < 2) {
            return false;
        }

        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) {
                return false;
            }
        }

        return true;
    }

    if (isset($_GET["number"])) { // Check if 'number' is set in the URL parameters
        $number = $_GET["number"];

        if (is_numeric($number) && $number > 0 && $number == round($number)) { // Check if the input is a positive number
            if (isPrime($number)) {
                echo "<p style=color:green>The number you entered ", $number, " is a prime number.</p>";
            } else {
                echo "<p style=color:red>The number you entered ", $number, " is not a prime number.</p>";
            }
        } else {
            echo "<p style='color:red;'>Please enter a positive number.</p>";
        }
    } else {
        echo "<p>Please enter a number.</p>";
    }
    ?>
</body>

</html>