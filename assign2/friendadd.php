<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
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

// Retrieve the profile name and friend_id of the logged-in user
$profile_name = $_SESSION["profile_name"];
$user_id = $_SESSION["friend_id"];

// Pagination settings
$limit = 5; // limit to 5 names per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch total number of friends
$sql = "SELECT COUNT(*) as count FROM myfriends WHERE friend_id1 = ? OR friend_id2 = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$stmt->bind_result($friend_count);
$stmt->fetch();
$stmt->close();

// Fetch non-friends
$sql = "SELECT f.friend_id, f.profile_name,
           (SELECT COUNT(*) FROM myfriends m1 
            JOIN myfriends m2 ON m1.friend_id2 = m2.friend_id2 
            WHERE m1.friend_id1 = ? AND m2.friend_id1 = f.friend_id) AS mutual_count
        FROM friends f
        WHERE f.friend_id != ? 
          AND f.friend_id NOT IN (SELECT friend_id2 FROM myfriends WHERE friend_id1 = ? UNION SELECT friend_id1 FROM myfriends WHERE friend_id2 = ?)
        ORDER BY f.profile_name
        LIMIT ? OFFSET ?";  
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiiiii", $user_id, $user_id, $user_id, $user_id, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
$non_friends = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Handle add friend action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_friend_id'])) {
    $add_friend_id = $_POST['add_friend_id'];

    // Insert friendship into myfriends table
    $insert_sql = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES (?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $user_id, $add_friend_id);
    $insert_stmt->execute();
    $insert_stmt->close();

    // Increment num_of_friends for both the current user and the added friend
    $update_sql = "UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = ? OR friend_id = ?";
    if ($update_stmt = $conn->prepare($update_sql)) {
        $update_stmt->bind_param("ii", $user_id, $add_friend_id);
        $update_stmt->execute();
        $update_stmt->close();
    }
    // Refresh the page to update the list and count
    header("location: friendadd.php?page=" . $page);
    exit;
}

// Calculate total pages for pagination
$sql = "SELECT COUNT(*) as count FROM friends f
        WHERE f.friend_id != ? 
          AND f.friend_id NOT IN (SELECT friend_id2 FROM myfriends WHERE friend_id1 = ? UNION SELECT friend_id1 FROM myfriends WHERE friend_id2 = ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$stmt->bind_result($total_non_friends);
$stmt->fetch();
$total_pages = ceil($total_non_friends / $limit);
$stmt->close();

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
            <li class="content"><a class="btn" href="friendlist.php">List Friend</a></li>
            <li class="content"><a class="btn" href="logout.php">Log Out</a></li>
        </ul>
    </nav>

    <h2><?php echo htmlspecialchars($profile_name); ?>'s Add Friend Page</h2>
    <p class="friend">Total number of friends is <?php echo $friend_count; ?></p>

    <table>
        <tr>
            <th>Friend Name</th>
            <th>Mutual Friends</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($non_friends)): ?>
            <?php foreach ($non_friends as $non_friend): ?>
                <tr>
                    <td><?php echo htmlspecialchars($non_friend['profile_name']); ?></td>
                    <td><?php echo $non_friend['mutual_count']; ?> mutual friends</td>
                    <td>
                        <form action="friendadd.php?page=<?php echo $page; ?>" method="post">
                            <input type="hidden" name="add_friend_id" value="<?php echo $non_friend['friend_id']; ?>">
                            <button type="submit" class="btn">Add as friend</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No friends available to add.</td>
            </tr>
        <?php endif; ?>
    </table>

    <!-- Pagination Links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="friendadd.php?page=<?php echo $page - 1; ?>">Previous</a>
        <?php endif; ?>
        <?php if ($page < $total_pages): ?>
            <a href="friendadd.php?page=<?php echo $page + 1; ?>">Next</a>
        <?php endif; ?>
    </div>

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