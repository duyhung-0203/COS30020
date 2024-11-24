<?php
if (isset($_COOKIE['lastVisit']))
    $LastVisit = "<p>Your last visit was on " . $_COOKIE['lastVisit'];
else {
    $LastVisit = "<p>This is your first visit!</p>";
    setcookie("lastVisit", date("F j, Y, g:i a"), time() + 60 * 60 * 24 * 365);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Web application development"/>
    <meta name="keywords" content="PHP"/>
    <meta name="author" content="Do Duy Hung"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Last Visit</title>
    <link rel="stylesheet" href="php_styles.css" type="text/css"/>
</head>

<body>
<?= $LastVisit ?>
</body>

</html>