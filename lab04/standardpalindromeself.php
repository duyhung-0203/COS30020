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
    if (isset($_POST["data"])) {  // Check if form data exists
        $str = trim($_POST["data"]);  // Obtain the form data and trim any leading/trailing spaces
    
        // Check if the input is empty
        if (empty($str)) {
            echo "<p style='color: red'>Please enter a string from the input form.</p>";
        } 
        // Check if the input contains numbers
        else if (preg_match('/\d/', $str)) {
            echo "<p style='color: red'>Please enter a text string without numbers.</p>";
        } else {
            // Remove spaces, punctuation, and special characters
            $newStr = str_replace([" ", "'", ".", ",", "!", "?"], '', $str);
            $string = strtolower($newStr);
    
            // Check if the string is a palindrome
            if (strcmp($string, strrev($string)) == 0) {
                echo "<p style='color: green'>The text you entered <b>'$str'</b> is a perfect palindrome!</p>";
            } else {
                echo "<p style='color: red'>The text you entered <b>'$str'</b> is not a perfect palindrome!</p>";
            }
        }
    } else {  // If no input is provided
        echo "<p>Please enter a string from the input form.</p>";
    }
?>
    <form action="standardpalindromeself.php" method="post" novalidate>
        <p>
            <label for="data">String:</label>
            <input type="text" name="data" id="data" required="required">
        </p>
        <p>
            <input type="submit" value="Check for Perfect Palindrome">
        </p>
    </form>
    <hr>
</body>

</html>