<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Web application development">
    <meta name="keywords" content="PHP">
    <meta name="author" content="Do Duy Hung">
    <title>TITLE</title>
</head>

<body>
    <h1>Lab04 Task 2 - Perfect Palindrome</h1>
    <hr>
    <?php
    if (isset($_POST["data"])) {
        $str = $_POST["data"];
        $pattern = "/^[A-Za-z ]+$/";
        
        // Check if the string matches the pattern (letters and spaces only)
        if (preg_match($pattern, $str)) {
            // Check if the string is a palindrome
            if (strcmp($str, strrev($str)) == 0) {
                echo "<p style='color: green'>The text you entered <b>'$str'</b> is a perfect palindrome!</p>";
            } else {
                echo "<p style='color: red'>The text you entered <b>'$str'</b> is not a perfect palindrome!</p>";
            }
        } else { // If the string does not match the pattern
            echo "<p>Please enter a string containing only letters or spaces.</p>";
        }
    } else { // If no input is provided
        echo "<p>Please enter a string from the input form.</p>";
    }    
    ?>
</body>

</html>