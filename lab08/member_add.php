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
    <h1>Web Programming - Lab08</h1>
    <?php
    // Establish DB connection
    require_once("settings.php");
    $table = "vipmembers";
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm)
        or die('Failed to connect to server');
    @mysqli_select_db($conn, $dbnm) or die("Database selection failed: " . mysqli_error($conn));

    // Check if the table exists
    $tableExistsQuery = "SHOW TABLES LIKE '$table'";
    $tableExistsResult = mysqli_query($conn, $tableExistsQuery);

    if (mysqli_num_rows($tableExistsResult) == 0) {
        // Create "vipmembers" table if it doesn't exist
        $sql = "CREATE TABLE $table (
        member_id INT AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(40),
        lname VARCHAR(40),
        gender VARCHAR(1),
        email VARCHAR(40),
        phone VARCHAR(20)
    )";

        // Execute the query and check for any errors
        if (mysqli_query($conn, $sql)) {
            echo "<p style='color:green'>Table created successfully</p>";
        } else {
            echo "<p style='color:red'>Error creating table: " . mysqli_error($conn) . "</p>";
        }
    }

    // Initialize an array to store error messages
    $errors = [];

    // Get form data values
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["gender"]) && trim(isset($_POST["email"])) && isset($_POST["phone"])) {
        // Check if any field is empty and add error messages to the $errors array
        if (empty($_POST["fname"])) {
            $errors[] = "First name is required.";
        }
        if (empty($_POST["lname"])) {
            $errors[] = "Last name is required.";
        }
        if (empty($_POST["gender"])) {
            $errors[] = "Gender is required.";
        }
        if (empty($_POST["email"])) {
            $errors[] = "Email is required.";
        }
        if (empty($_POST["phone"])) {
            $errors[] = "Phone number is required.";
        }

        // Validation regex patterns
        $regexEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $regexPhone = "/^[0-9]{10}$/";
        $regexName = "/^[a-zA-Z]+$/";

        // Additional validation checks
        if (!empty($_POST["fname"]) && !preg_match($regexName, trim($_POST["fname"]))) {
            $errors[] = "First name should not contain numbers or special characters.";
        }
        if (!empty($_POST["lname"]) && !preg_match($regexName, trim($_POST["lname"]))) {
            $errors[] = "Last name should not contain numbers or special characters.";
        }
        if (!empty($_POST["email"]) && !preg_match($regexEmail, trim($_POST["email"]))) {
            $errors[] = "Email address is not valid.";
        }
        if (!empty($_POST["phone"]) && !preg_match($regexPhone, trim($_POST["phone"]))) {
            $errors[] = "Phone number is not valid. It should contain exactly 10 digits.";
        }

        // Display all error messages if there are any
        if (!empty($errors)) {
            echo "<p style='color:red'>" . implode("<br>", $errors) . "</p>";
        } else {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $gender = $_POST["gender"];
            $email = trim($_POST["email"]);
            $phone = $_POST["phone"];

            // Check if the record already exists
            $existingQuery = "SELECT * FROM vipmembers WHERE email = '$email' AND phone = '$phone'";
            $existingResult = mysqli_query($conn, $existingQuery);

            if (mysqli_num_rows($existingResult) > 0) {
                echo "<p style='color:red'>A member with the same email and phone already exists.</p>";
            } else {
                // Insert statement
                $sql = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
                // Execute the query and check for any errors
                if (mysqli_query($conn, $sql)) {
                    echo "<p style='color:green'>Data inserted successfully</p>";
                } else {
                    echo "<p style='color:red'>Error inserting data: " . mysqli_error($conn) . "</p>";
                }
            }
        }
    } else {
        echo "<p style='color:red'>All fields are required.</p>";
    }

    // Close connection
    mysqli_close($conn);
    ?>

</body>

</html>