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
    <h1>Web Programming Form - Lab 6</h1>
    <hr>

    <?php
    // Set umask to ensure proper file permissions
    umask(0007);

    // Define the directory path where guestbook data will be stored
    $dir = "../../data/lab06";

    // Create the directory if it doesn't exist, with permissions 02770
    if (!file_exists($dir)) {
        mkdir($dir, 02770);
    }

    // Check if both name and email are submitted and not empty
    if (isset($_POST["name"]) && isset($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["email"])) {
        $name = $_POST["name"];  // Retrieve the name from the form
        $email = $_POST["email"];  // Retrieve the email from the form
    
        // Define a regex pattern to allow alphabetic characters, spaces, hyphens, and apostrophes for the name
        $pattern = "/^[A-Za-z' -]+$/";
        // Validate email format (improved pattern to match a broader range of valid emails)
        $emailForm = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

        // Validate that name contains only allowed characters and email is in the correct format
        if (preg_match($pattern, $name) && preg_match($emailForm, $email)) {
            // Define the file path where the guestbook data will be saved
            $filename = "../../data/lab06/guestbook.txt";

            $nameArr = array();
            $emailArr = array();

            // If the file exists, process the data inside it
            if (file_exists($filename)) {
                $handle = fopen($filename, "r");
                while (!feof($handle)) {
                    $line = fgets($handle);
                    $lineArr = explode(",", $line);
                    if (count($lineArr) == 2) {
                        array_push($nameArr, $lineArr[0]);
                        array_push($emailArr, trim($lineArr[1]));
                    }
                }
                fclose($handle);
            }

            // var_dump($emailArr);

            // Check if the name and email are new
            if (!in_array($name, $nameArr) && !in_array($email, $emailArr)) {
                $handle = fopen($filename, "a");
                $data = $name . "," . $email . "\n";
                fwrite($handle, $data);
                fclose($handle);
                echo "<p style='color:green'>Thank you for signing our guest book:</p>";
                echo "<p><b>Name</b>: $name<br><b>E-mail</b>: $email</p>";
            } else {
                echo "<p style='color:red'>You have already signed our guest book!</p>";
            }
        } else {
            // If the name or email contains invalid characters, display an error message
            echo "<p style='color:red'>Name or email is in an incorrect format!<br>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>";
        }
    } else {
        // If name or email is not submitted, display an error message
        echo "<p style='color:red'>Name or email is missing!<br>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>";
    }

    // Provide a link to show the guestbook content
    echo '<p><a href="guestbookform.php">Add another visitors</a><br><a href="guestbookshow.php">View Guest Book</a></p>';
    ?>


</body>

</html>