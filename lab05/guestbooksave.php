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
    <h1>Web Programming Form - Lab 5</h1>
    <hr>

    <?php
    // Set umask to ensure proper file permissions
    umask(0007);

    // Define the directory path where guestbook data will be stored
    $dir = "../../data/lab05";

    // Create the directory if it doesn't exist, with permissions 02770
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }

    // Check if both first and last name are submitted and not empty
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && !empty($_POST["fname"]) && !empty($_POST["lname"])) {
        $fName = $_POST["fname"];  // Retrieve the first name from the form
        $lName = $_POST["lname"];  // Retrieve the last name from the form
    
        // Define a regex pattern to allow only alphabetic characters (A-Z, a-z)
        $pattern = "/^[A-Za-z]+$/";

        // Validate that both first and last names only contain alphabetic characters
        if (preg_match($pattern, $fName) && preg_match($pattern, $lName)) {
            // Define the file path where the guestbook data will be saved
            $filename = "../../data/lab05/guestbook.txt";
            // Open the file in append mode to add new entries
            $handle = fopen($filename, "a");

            // Prepare the data to write, concatenating first and last names
            $data = addslashes($fName . " " . $lName . "\n");
            // Write the data to the guestbook file
            fwrite($handle, $data);

            // Close the file after writing
            fclose($handle);
            // Display a success message after writing to the guestbook
            echo "<p style='color:green'>Thank you for signing our guest book!</p>";
        } else {
            // If the names contain invalid characters, display an error message
            echo "<p style='color:red'>Names must contain only alphabetic characters!<br>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>";
        }
    } else {
        // If the form was submitted without a first or last name, display an error
        echo "<p style='color:red'>You must enter your first and last name!<br>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>";
    }

    // Provide a link to show the guestbook content
    echo '<p><a href="guestbookshow.php">Show Guest Book</a></p>';
    ?>

</body>

</html>