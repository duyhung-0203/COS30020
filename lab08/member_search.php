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
    <form action="member_search.php" method="post">
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" novalidate />
        <br />
        <br />
        <input type="submit" value="Search Member" />
        <input type="reset" value="Clear" />
    </form>
    <?php
    // Check isset last name
    if (isset($_POST["lname"]) && !empty($_POST["lname"])) {
        $lname = strtolower($_POST["lname"]);
        require_once("settings.php");
        // Connect to the database
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm)
            or die('Failed to connect to server');
        // Use database
        @mysqli_select_db($conn, $dbnm)
            or die('Database not available');
        // Create SQL query
        $query = "SELECT * FROM vipmembers WHERE LOWER(lname) LIKE '%$lname%'";
        // Execute SQL query
        $result = mysqli_query($conn, $query)
            or die('Error in querying database');
        // Display results
        echo "<table border='1'>";
        echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
        <td>{$row['member_id']}</td>
        <td>{$row['fname']}</td>
        <td>{$row['lname']}</td>
        <td>{$row['email']}</td>
      </tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
        // Close connection
        mysqli_close($conn);
    } else {
        echo "<p style='color:red'>Last name is required.</p>";
    }
    ?>

</body>

</html>