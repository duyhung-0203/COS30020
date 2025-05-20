<!-- Because my feenix-mariadb account is still locking with MySql, so maybe my website on Mercury is not work. Can you check for me locally with localhost? Thanks you -->

<?php
mysqli_report(MYSQLI_REPORT_OFF);
// $host = "feenix-mariadb.swin.edu.au";
$host = "localhost";
$user = "root"; // your user name
$password = ""; // your password d(date of birth – ddmmyy)
$database = "oidoioi"; // your database
// tabels used
$table1 = "friends";
$table2 = "myfriends";
$table3 = "setup_log";

// Connect to database
$conn = @mysqli_connect($host, $user, $password, $database);
if (!$conn) {
  // Get error message
  $errMsg = mysqli_connect_error();
  $errNo = mysqli_connect_errno();
  session_start();
  // Store error message in session variable and redirect to error page
  $_SESSION["errMsg"] = $errMsg;
  $_SESSION["errNo"] = $errNo;
  header("Location: errorhehe.php");
  exit();
}
?>