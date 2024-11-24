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
<h1>Web Programming - Lab10</h1>
<form method="post">
    <!-- Form fields for database connection details -->
    <p>Username: <input name="username" /></p>
    <p>Password: <input name="password" type="password" /></p>
    <p>Database name: <input name="dbname" /></p>
    <p>
        <input type="submit" value="Set Up" />
        <input type="reset" value="Reset" />
    </p>
</form>
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Specify the database host
//    $host = "feenix-mariadb.swin.edu.au"; // Uncomment this line for specific server
    $host = "localhost"; // Default localhost setting

    // Check if required form fields are set and not empty
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["dbname"]) && !empty($_POST["username"]) && !empty($_POST["dbname"])) {
        // Retrieve form data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $dbname = $_POST["dbname"];

        // Establish connection to the database
        $dbConnect = new mysqli($host, $username, $password, $dbname);

        // Check for connection errors
        if ($dbConnect->connect_error)
            die("<p>Unable to connect to the database server.</p>"
                . "<p>Error code " . $dbConnect->connect_errno
                . ": " . $dbConnect->connect_error . "</p>");
        else {
            // SQL queries to create 'hitcounter' table and insert initial data
            $table = "hitcounter";
            $sql1 = "CREATE TABLE $table ( `id` SMALLINT NOT NULL PRIMARY KEY, `hits` SMALLINT NOT NULL );";
            $sql2 = "INSERT INTO $table VALUES (1,0);";

            // Execute the table creation query
            $queryResult = $dbConnect->query($sql1)
            or die("<p>Unable to execute the query.</p>"
                . "<p>Error code " . $dbConnect->errno
                . ": " . $dbConnect->error . "</p>");

            // Execute the initial data insertion query
            $queryResult = $dbConnect->query($sql2)
            or die("<p>Unable to execute the query.</p>"
                . "<p>Error code " . $dbConnect->errno
                . ": " . $dbConnect->error . "</p>");

            // Display success message
            echo "<p>Database successfully set up.</p>";

            // Write database connection details to a file
            umask(0007); // Set file permissions mask
            $directory = "../../data/lab10";

            // Create directory if it doesn't exist
            if (!file_exists($directory)) {
                mkdir($directory, 02770);
            }

            $filename = "../../data/lab10/mykeys.txt";
            // Open file with write permissions ('w' flag)
            $handle = fopen($filename, "w");

            // Check if the file was successfully opened
            if (!$handle) {
                echo "<p>Unable to open the file.</p>";
            } else {
                // Prepare and write data to the file
                $data = $host . "\n" . $username . "\n" . $password . "\n" . $dbname . "\n";
                fwrite($handle, $data);
                fclose($handle); // Close the file after writing

                // Display messages indicating success
                echo "<p>Database connection details written to file.</p>";
                echo "<p><a href='countvisit.php'>Count Visits</a></p>";
            }
        }
        $dbConnect->close(); // Close the database connection
    } else {
        // Prompt user to enter all necessary details if any field is missing
        echo "<p>Please enter all database connection details.</p>";
    }
}
?>

</html>
