<?php
// Database configuration
global $host, $user, $password, $database;
require_once('settings.php');

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create setup_log table if it doesn't exist
$createSetupLogTable = "CREATE TABLE IF NOT EXISTS setup_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setup_completed TINYINT(1) NOT NULL DEFAULT 0
)";
$conn->query($createSetupLogTable);

// Check if setup has already been completed
$setupCompleted = false;
$checkSetupLog = "SELECT setup_completed FROM setup_log WHERE id = 1";
$result = $conn->query($checkSetupLog);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $setupCompleted = $row['setup_completed'] == 1;
}

// Only create tables and insert data if setup hasn't been completed
$message = '';
if (!$setupCompleted) {
    // Create friends and myfriends tables if they don't exist
    $createFriendsTable = "CREATE TABLE IF NOT EXISTS friends (
        friend_id INT AUTO_INCREMENT PRIMARY KEY,
        friend_email VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(20) NOT NULL,
        profile_name VARCHAR(30) NOT NULL,
        date_started DATE NOT NULL,
        num_of_friends INT UNSIGNED DEFAULT 0
    )";

    $createMyFriendsTable = "CREATE TABLE IF NOT EXISTS myfriends (
        friend_id1 INT NOT NULL,
        friend_id2 INT NOT NULL,
        PRIMARY KEY (friend_id1, friend_id2),
        FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
        FOREIGN KEY (friend_id2) REFERENCES friends(friend_id)
    )";

    // Attempt to create tables
    $friendsTableCreated = $conn->query($createFriendsTable);
    $myFriendsTableCreated = $conn->query($createMyFriendsTable);

    // Populate 'friends' table with sample data if empty
    $checkFriendsTable = "SELECT COUNT(*) AS count FROM friends";
    $result = $conn->query($checkFriendsTable);
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        $sampleFriends = [
            ['khanh.linh@gmail.com', 'nkl911', 'Khanh Linh Nguyen', '2022-10-02', 3],
            ['luong.duc@gmail.com', 'lmd102', 'Minh Duc Luong', '2023-05-09', 4],
            ['minh.anh@gmail.com', 'nma182', 'Minh Anh Nguyen', '2019-08-01', 4],
            ['pham.linh@gmail.com', 'pkl710', 'Khanh Linh Pham', '2019-08-01', 4],
            ['khanh.ngoc@gmail.com', 'pkn220', 'Khanh Ngoc Pham', '2019-08-01', 4],
            ['cong.duy@gmail.com', 'bcd131', 'Cong Duy Bui', '2020-10-30', 4],
            ['quang.huy@gmail.com', 'lqh078', 'Quang Huy Lam', '2010-11-15', 4],
            ['ngoc.minh@gmail.com', 'pmn112', 'Ngoc Minh Phan', '2018-01-09', 4],
            ['an.chi@gmail.com', 'ntac176', 'Truong An Chi Nguyen', '2015-08-30', 4],
            ['nhat.nam@gmail.com', 'cnn293', 'Nhat Nam Cao', '2010-08-03', 2],
        ];

        $insertFriends = $conn->prepare("INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES (?, ?, ?, ?, ?)");
        foreach ($sampleFriends as $friend) {
            $insertFriends->bind_param('ssssi', $friend[0], $friend[1], $friend[2], $friend[3], $friend[4]);
            $insertFriends->execute();
        }
        $insertFriends->close();
    }

    // Populate 'myfriends' table with sample data if empty
    $checkMyFriendsTable = "SELECT COUNT(*) AS count FROM myfriends";
    $result = $conn->query($checkMyFriendsTable);
    $row = $result->fetch_assoc();

    if ($row['count'] == 0) {
        $sampleMyFriends = [
            [1, 2],
            [1, 3],
            [1, 4],
            [2, 3],
            [2, 5],
            [2, 6],
            [3, 4],
            [3, 7],
            [3, 8],
            [4, 5],
            [4, 9],
            [4, 10],
            [5, 6],
            [5, 7],
            [5, 8],
            [6, 7],
            [6, 9],
            [7, 8],
            [8, 9],
            [9, 10]
        ];

        $insertMyFriends = $conn->prepare("INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)");
        foreach ($sampleMyFriends as $friendPair) {
            $insertMyFriends->bind_param('ii', $friendPair[0], $friendPair[1]);
            $insertMyFriends->execute();
        }
        $insertMyFriends->close();
    }

    // Update setup_log table to indicate setup is complete
    $conn->query("INSERT INTO setup_log (id, setup_completed) VALUES (1, 1) ON DUPLICATE KEY UPDATE setup_completed = 1");

    // Set the success message for the first time
    $message = "Tables successfully created or populated.";
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags to define character encoding, responsive behavior, and basic description -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Application Development :: Assignment 2">
    <meta name="keywords" content="Web,programming">
    <meta name="author" content="author" author="Do Duy Hung">

    <!-- Link to external CSS stylesheet -->
    <link rel="stylesheet" href="styles/styles.css">
    <title>Home</title> <!-- Title of the webpage -->
    <!-- Mercury link: https://mercury.swin.edu.au/cos30020/s104182779/assign2/ -->
</head>

<body>
    <!-- Main heading of the page -->
    <h1 class="header">My Friend System</h1>

    <!-- Navigation bar -->
    <nav>
        <ul class="list">
            <!-- Links to different sections of the system -->
            <li class="content"><a class="btn" href="signup.php">Sign Up</a></li>
            <li class="content"><a class="btn" href="login.php">Log In</a></li>
            <li class="content"><a class="btn" href="about.php">About</a></li>
        </ul>
    </nav>
    <h2>Home Page</h2>
    <!-- Section for displaying user information -->
    <div class="information">
        <div class="row">
            <div class="name">
                <p>Name: </p>
            </div>
            <div class="infor-name">
                <p>Duy Hung Do</p> <!-- User's name -->
            </div>
        </div>

        <div class="row">
            <div class="name">
                <p>Student ID: </p>
            </div>
            <div class="infor-name">
                <p>104182779</p> <!-- Student ID -->
            </div>
        </div>

        <div class="row">
            <div class="name">
                <p>Email </p>
            </div>
            <div class="infor-name">
                <!-- Email link for user -->
                <p class="mail"><a href="mailto:104182779@student.swin.edu.au">104182779@student.swin.edu.au</a></p>
            </div>
        </div>

        <!-- Declaration statement for assignment integrity -->
        <div class="row">
            <p class="para">I declare that this assignment is my individual work. I have not worked collaboratively, nor
                have I copied from any other student's work or from any other source.</p>
        </div>
        <!-- Message to display success or failure of table creation -->
        <div class="row">
            <?php if (!empty($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
        <!-- Placeholder div for content push effect (if necessary) -->
        <div class="push">

        </div>

    </div>

    <!-- Footer section -->
    <footer>
        <div class="box_footer">
            <!-- Quick links section -->
            <div class="box">
                <div class="footer_properties">
                    <h3>Quick links</h3>
                </div>
                <a href="index.php"><i class="fa-solid fa-house"> Home</i></a>
                <a href="about.php"><i class="fa-regular fa-user"> About</i></a>
                <a href="signup.php"><i class="fa-solid fa-suitcase"> Sign Up</i></a>
                <a href="login.php"><i class="fa-solid fa-file-lines"> Log In</i></a>
            </div>

            <!-- Contact us section with social media links -->
            <div class="box">
                <div class="footer_properties">
                    <h3>Contact us</h3>
                </div>
                <a href="#"><i class="fa-brands fa-facebook"> FaceBook</i></a>
                <a href="#"><i class="fa-brands fa-instagram"> Instagram</i></a>
                <a href="#"><i class="fa-brands fa-youtube"> Youtube</i></a>
            </div>

            <!-- Address section -->
            <div class="box">
                <div class="footer_properties">
                    <h3>Address</h3>
                </div>
                <address><i class="fa-solid fa-map-pin"> 80 Duy Tan, Cau Giay, Ha Noi</i></address>
                <address><i class="fa-solid fa-map-pin"> 02 Duong Khue, Mai Dich, Cau Giay, Hanoi</i></address>
            </div>
        </div>

        <!-- Footer copyright information -->
        <hr>
        <p class="copy-right">Copyright © HUNG FIND FRIEND</p>
    </footer>

</body>

</html>