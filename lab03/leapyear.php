<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Web Application Development :: Lab 1" />
    <meta name="keywords" content="Web,programming" />
    <meta name="author" author="Do Duy Hung" />
    <title>Leap Year Checker</title>
</head>

<body>
    <h1>Lab03 Task 2 - Leap year</h1>
    <hr>

    <?php
    // Define function to check for leap year
    function is_leapyear($year)
    {
        if (is_numeric($year) && $year > 0 && $year == round($year)) {
            if ($year % 4 == 0) {
                if ($year % 100 == 0) {
                    if ($year % 400 == 0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false; // Invalid input case
        }
    }

    // Check if the form has been submitted and year parameter is set
    if (isset($_GET["year"])) {
        $year = $_GET["year"];

        // Ensure that the input is valid
        if (is_numeric($year) && $year > 0 && $year == round($year)) {
            // Call the leap year function and display the result
            if (is_leapyear($year)) {
                echo "<p style='color:green'>The year $year is a leap year.</p>";
            } else {
                echo "<p style='color:red'>The year $year is not a leap year.</p>";
            }
        } else {
            echo "<p style='color:red'>Please enter a valid number for the year.</p>";
        }
    }
    else {
        echo "<p>Please enter a year.</p>";
    }
    ?>

</body>

</html>