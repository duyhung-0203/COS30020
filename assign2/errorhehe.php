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
    <h2>Home Page</h2>
    <div class="information">
    <?php
    session_start();
    // check if error message is set
    if (isset($_SESSION["errMsg"]) && isset($_SESSION["errNo"])) {
        $errMsg = $_SESSION["errMsg"];
        $errNo = $_SESSION["errNo"];
        echo "<p class='errorpage'><b>Error encountered: </b><br>$errMsg (Code: $errNo).</br></p>";
    } else {
        echo "<p>No error encountered. Redirecting to the home page...</p>";
    }

    // Redirect to logout page to: 
    // - unset all session variables
    // - redirect to the home page
    // - home page will redirect to error page if there is an error
    // - keep this loop unless there is no error
    header("Refresh: 5; URL=logout.php");
    ?>
    </div>
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