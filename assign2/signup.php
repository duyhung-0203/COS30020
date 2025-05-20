<?php
// Initialize the settings
global $host, $user, $password, $database;
require_once("settings.php");

$conn = new mysqli($host, $user, $password, $database);

// Start session
session_start();

// Initialize variables
$email = $name = $pass = $confirm_pass = "";
$email_err = $name_err = $pass_err = $confirm_pass_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the profile name (letters only)
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", trim($_POST["name"]))) {
        $name_err = "Profile name must contain only letters and spaces.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate the email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        // Check if the email already exists
        $sql = "SELECT friend_id FROM friends WHERE friend_email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($_POST["email"]);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $email_err = "This email is already registered.";
            } else {
                $email = trim($_POST["email"]);
            }
            $stmt->close();
        }
    }

    // Validate the password
    if (empty(trim($_POST["password"]))) {
        $pass_err = "Please enter a password.";
    } elseif (!preg_match("/^[a-zA-Z0-9]+$/", trim($_POST["password"]))) {
        $pass_err = "Password must contain only letters and numbers.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $pass_err = "Password must have at least 8 characters.";
    } else {
        $pass = trim($_POST["password"]);
    }

    // Confirm password validation
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_pass_err = "Please confirm the password.";
    } else {
        $confirm_pass = trim($_POST["confirm_password"]);
        if (empty($pass_err) && ($pass != $confirm_pass)) {
            $confirm_pass_err = "Passwords do not match.";
        }
    }

    // Insert new user if no errors
    if (empty($name_err) && empty($email_err) && empty($pass_err) && empty($confirm_pass_err)) {
        $sql = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES (?, ?, ?, NOW(), 0)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $param_email, $param_password, $param_name);
            $param_email = $email;
            $param_password = $pass;// Secure password
            $param_name = $name;

            if ($stmt->execute()) {
                // Retrieve the newly created friend_id
                $friend_id = $stmt->insert_id;

                // Set session variables
                // $_SESSION["logg"] = true;
                $_SESSION["friend_id"] = $friend_id;
                $_SESSION["friend_email"] = $email;
                $_SESSION["profile_name"] = $name;

                // Redirect to friendadd.php
                header("location: friendadd.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <!-- Main heading of the page -->
    <h1 class="header">My Friend System</h1>

    <!-- Navigation bar -->
    <nav>
        <ul class="list">
            <!-- Links to different sections of the system -->
            <li class="content now"><a class="btn" href="index.php">Home</a></li>
            <li class="content"><a class="btn" href="login.php">Log In</a></li>
            <li class="content"><a class="btn" href="about.php">About</a></li>
        </ul>
    </nav>

    <h2>Register</h2>
    <!-- Form to register -->
    <form action="signup.php" method="post">
        <div class="form-group">
            <!-- Email input -->
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
            <span class="error"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group">
            <!-- Name input -->
            <label>Profile Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($name); ?>">
            <span class="error"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group">
            <!-- Password input -->
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="error"><?php echo $pass_err; ?></span>
        </div>
        <div class="form-group">
            <!-- Confirm password input -->
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
            <span class="error"><?php echo $confirm_pass_err; ?></span>
        </div>
        <div class="form-group">
            <button type="submit" class="btn">Register</button>
            <button type="reset" class="btn">Clear</button>
        </div>
        <!-- Link to Home Page -->
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
    <p><a href="index.php">Back to Home</a></p>

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
                <a href="#"><i class="fa-brands fa-facebook"> Facebook</i></a>
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