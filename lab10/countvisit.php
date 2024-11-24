<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Web application development"/>
    <meta name="keywords" content="PHP"/>
    <meta name="author" content="Do Duy Hung"/>
    <title>Web Programming - Lab10</title>
</head>

<body>
<h1>Hit Counter</h1>
<?php
require_once("hitcounter.php"); // Include the HitCounter class

// Set file permissions mask for secure file creation
umask(0007);

// Define the directory to store database connection details
$directory = "../../data/lab10";

// Create the directory if it doesn't exist
if (!file_exists($directory)) {
    mkdir($directory, 02777, true);
}

$filename = "../../data/lab10/mykeys.txt";

// Open the file containing database connection details
$handle = @fopen($filename, "r");

// Check if the file was successfully opened
if (!$handle) {
    echo "<p>Unable to open the file.</p>";
} else {
    // Read each line of the file to get database connection details
    $host = trim(fgets($handle)); // Get database host
    $username = trim(fgets($handle)); // Get database username
    $password = trim(fgets($handle)); // Get database password
    $dbname = trim(fgets($handle)); // Get database name
    fclose($handle); // Close the file after reading details

    // Create a new instance of HitCounter with the connection details
    $Counter = new HitCounter($host, $username, $password, $dbname);

    // Retrieve the current hit count from the database
    $hit = $Counter->getHits();
    echo "<p>This page has received $hit hits.</p>"; // Display the current hit count

    // Increment the hit count
    $hit++;

    // Update the hit count in the database
    $Counter->setHits($hit);

    // Close the database connection
    $Counter->closeConnection();
}
?>
<p><a href="startover.php">Start Over</a></p> <!-- Link to reset the hit counter -->
</body>

</html>
