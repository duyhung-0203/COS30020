<?php
// Initialize the settings
global $host, $user, $password, $database;
require_once("settings.php");

$conn = new mysqli($host, $user, $password, $database);

// Start session
session_start();

// Initialize variables
$email = $pass = "";
$email_err = $pass_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $pass_err = "Please enter your password.";
    } else {
        $pass = trim($_POST["password"]);
    }

    // Check credentials if no errors
    if (empty($email_err) && empty($pass_err)) {
        // Prepare a select statement
        $sql = "SELECT friend_id, friend_email, password, profile_name FROM friends WHERE friend_email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;

            // Execute the statement
            if ($stmt->execute()) {
                $stmt->store_result();

                // Check if email exists
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($friend_id, $friend_email, $stored_password, $profile_name);
                    if ($stmt->fetch()) {
                        // Direct comparison of plain-text passwords
                        if ($pass === $stored_password) {
                            // Start a new session and set session variables
                            $_SESSION["friend_id"] = $friend_id;
                            $_SESSION["friend_email"] = $friend_email;
                            $_SESSION["profile_name"] = $profile_name;

                            // Redirect to friendlist.php
                            header("location: friendlist.php");
                            exit;
                        } else {
                            $pass_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $conn->close();
}
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
            <li class="content now"><a class="btn" href="index.php">Home</a></li>
            <li class="content"><a class="btn" href="signup.php">Sign Up</a></li>
            <li class="content"><a class="btn" href="about.php">About</a></li>
        </ul>
    </nav>

    <h2>Log In</h2>
<!-- Form to handle user login -->
<form action="login.php" method="post">
    <!-- Email input field -->
    <div class="form-group">
        <label>Email</label>
        <!-- Display the email entered by the user (if any) while escaping special characters for security -->
        <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
        <!-- Display email validation error message -->
        <span class="error"><?php echo $email_err; ?></span>
    </div>

    <!-- Password input field -->
    <div class="form-group">
        <label>Password</label>
        <!-- Input field for password -->
        <input type="password" name="password" class="form-control">
        <!-- Display password validation error message -->
        <span class="error"><?php echo $pass_err; ?></span>
    </div>

    <!-- Buttons for submitting and resetting the form -->
    <div class="form-group">
        <!-- Submit button for logging in -->
        <button type="submit" class="btn">Log In</button>
        <!-- Reset button to clear all inputs -->
        <button type="reset" class="btn">Clear</button>
    </div>

    <!-- Link to the sign-up page for users who don't have an account -->
    <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
</form>

<!-- Link to navigate back to the home page -->
<p><a href="index.php">Back to Home</a></p>

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