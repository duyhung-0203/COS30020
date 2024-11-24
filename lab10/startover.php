<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Do Duy Hung" />
    <title>Web Programming - Lab10</title>
</head>

<body>
<h1>Hit Counter</h1>
<?php
require_once("hitcounter.php"); // Include the HitCounter class

// Set file permissions mask for secure file creation
umask(0007);

// Define the directory where the database connection details are stored
$directory = "../../data/lab10";

// Create the directory if it does not exist
if (!file_exists($directory)) {
    mkdir($directory, 02777, true);
}

$filename = "../../data/lab10/mykeys.txt";

// Open the file containing the database connection details in read mode
$handle = @fopen($filename, "r");

// Check if the file was successfully opened
if (!$handle) {
    echo "<p>Unable to open the file.</p>";
} else {
    // Read each line from the file to retrieve database connection details
    $host = trim(fgets($handle)); // Get database host
    $username = trim(fgets($handle)); // Get database username
    $password = trim(fgets($handle)); // Get database password
    $dbname = trim(fgets($handle)); // Get database name
    fclose($handle); // Close the file after reading

    // Create a new instance of HitCounter with the connection details
    $Counter = new HitCounter($host, $username, $password, $dbname);

    // Call the startOver() function to reset the hit count to zero
    $Counter->startOver();

    // Close the database connection
    $Counter->closeConnection();

    // Redirect the user to countvisit.php after resetting the counter
    header("Location: countvisit.php");
    exit(); // Ensure no further code is executed after redirection
}
?>
<p><a href="startover.php">Start Over</a></p> <!-- Link to manually reset the hit counter -->
</body>

</html>
