<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["friend_id"])) {
    header("location: login.php");
    exit;
}

// Database configuration
global $host, $user, $password, $database;
require_once('settings.php');

// Connect to the database
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the profile name of the logged-in user
$profile_name = $_SESSION["profile_name"];
$user_id = $_SESSION["friend_id"]; // Assumes the friend_id is stored in the session upon login

// Fetch the list of friends
$sql = "SELECT f.friend_id, f.profile_name 
        FROM friends f 
        INNER JOIN myfriends m ON (f.friend_id = m.friend_id2 OR f.friend_id = m.friend_id1)
        WHERE (m.friend_id1 = ? OR m.friend_id2 = ?) AND f.friend_id != ?
        ORDER BY f.profile_name";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$friends = $result->fetch_all(MYSQLI_ASSOC);
$friend_count = count($friends);
$stmt->close();

// Handle unfriend action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['unfriend_id'])) {
    $unfriend_id = $_POST['unfriend_id'];

    // Delete friend relationship from myfriends table
    $delete_sql = "DELETE FROM myfriends WHERE (friend_id1 = ? AND friend_id2 = ?) OR (friend_id1 = ? AND friend_id2 = ?)";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("iiii", $user_id, $unfriend_id, $unfriend_id, $user_id);
    $delete_stmt->execute();
    $delete_stmt->close();

    // Decrement num_of_friends for both users
    $update_sql = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = ? OR friend_id = ?";
    if ($update_stmt = $conn->prepare($update_sql)) {
        $update_stmt->bind_param("ii", $user_id, $unfriend_id);
        $update_stmt->execute();
        $update_stmt->close();
    }

    // Refresh the page to update the friend list and count
    header("location: friendlist.php");
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <h1 class="header">My Friend System</h1>

    <nav>
        <ul class="list">
            <li class="content"><a class="btn" href="friendadd.php">Add Friend</a></li>
            <li class="content"><a class="btn" href="logout.php">Log Out</a></li>
        </ul>
    </nav>

    <h2><?php echo htmlspecialchars($profile_name); ?>'s Friend List Page</h2>
    <p class="friend">Total number of friends is <?php echo $friend_count; ?></p>

    <table>
        <tr>
            <th>Friend Name</th>
            <th>Action</th>
        </tr>
        <?php if ($friend_count > 0): ?>
            <?php foreach ($friends as $friend): ?>
                <tr>
                    <td><?php echo htmlspecialchars($friend['profile_name']); ?></td>
                    <td>
                        <form action="friendlist.php" method="post">
                            <input type="hidden" name="unfriend_id" value="<?php echo $friend['friend_id']; ?>">
                            <button type="submit" class="btn">Unfriend</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">You have no friends added.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!--<p><a href="index.php">Back to Home</a></p>-->

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