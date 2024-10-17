<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Web Programming :: Lab 2">
    <meta name="keywords" content="Web,programming">
    <title>Using variables, arrays and operators</title>
</head>

<body>
    <h1>Web Programming - Lab 2</h1>
    <?php
    // Retrieve the number from the URL parameters or assign null if not set
    $number = isset($_GET['number']) ? $_GET['number'] : null;

    // Check if the input is numeric, round it, and determine its status (even/odd or invalid)
    $status = is_numeric($number)
        ? (round($number) % 2 == 0 ? "even" : "odd") 
        : "not a number";

    // Output the result
    echo is_numeric($number) 
        ? "The variable " . round($number) . " contains an $status number." 
        : "The variable is $status.";
    ?>
</body>

</html>
