<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Do Duy Hung" />
    <title>Lab 06 - Task 2</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        th, td {
            text-align: left;
        }

        a {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Lab 06 - Task 2</h1>
    <h2>View Guest Book</h2>
    <hr>
    
    <?php
    $filename = "../../data/lab06/guestbook.txt";

    if (is_readable($filename)) {
        $handle = fopen($filename, "r");
        if ($handle) {
            echo "<table>";
            echo "<tr><th>Number</th><th>Name</th><th>Email</th></tr>";
            
            $number = 1; // Start row numbering

            while (($line = fgets($handle)) !== false) {
                $lineArr = explode(",", $line); // Split the line by commas
                if (count($lineArr) == 2) { // Ensure the line contains both name and email
                    echo "<tr>";
                    echo "<td>{$number}</td>";
                    echo "<td>" . htmlspecialchars($lineArr[0]) . "</td>"; // Name
                    echo "<td>" . htmlspecialchars(trim($lineArr[1])) . "</td>"; // Email
                    echo "</tr>";
                    $number++; // Increment the number for each entry
                }
            }

            echo "</table>";
            fclose($handle);
        } else {
            echo "<p>Cannot open the guestbook file.</p>";
        }
    } else {
        echo "<p>Guestbook is empty or not accessible.</p>";
    }
    ?>
    
    <p><a href="guestbookform.php">Add Another Visitor</a></p>
</body>

</html>
