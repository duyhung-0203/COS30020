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
    $filename = "../../data/lab05/guestbook.txt";

    if (is_readable($filename)) {
        $entries = file_get_contents($filename);
        $entries = stripslashes($entries);

        echo "<pre>", $entries, "</pre>";
    } else {
        echo "Guestbook is empty or not accessible.";
    }
    $filename = "../../data/lab05/guestbook.txt";

    // if (is_readable($filename)) {
    //     $handle = fopen($filename, "r"); // Open the file for reading
    //     if ($handle) {
    //         echo "<pre>"; // Start displaying with <pre>
    //         while (($line = fgets($handle)) !== false) {
    //             echo stripslashes($line); // Remove backslashes and print the line
    //         }
    //         echo "</pre>"; // End displaying with </pre>
    //         fclose($handle); // Close the file
    //     } else {
    //         echo "Cannot open the file.";
    //     }
    // } else {
    //     echo "Guestbook is empty or not accessible.";
    // }
    ?>
    <?php
    $filename = "../../data/lab05/guestbook.txt";

    if (is_readable($filename)) {
        $handle = fopen($filename, "r"); // Open the file for reading
        if ($handle) {
            echo "<pre>"; // Start displaying with <pre>
            while (($line = fgets($handle)) !== false) {
                echo stripslashes($line); // Remove backslashes and print the line
            }
            echo "</pre>"; // End displaying with </pre>
            fclose($handle); // Close the file
        } else {
            echo "Cannot open the file.";
        }
    } else {
        echo "Guestbook is empty or not accessible.";
    }
    ?>


    <p><a href="guestbookshow.php">Show Guest Book</a></p>
</body>

</html>