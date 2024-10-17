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
    // Declare and initialise array
    $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    echo "<p>The days of the week in English are: $days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6].</p>";
    // Modify the array
    $days[0] = "Dimanche";
    $days[1] = "Lundi";
    $days[2] = "Mardi";
    $days[3] = "Mercredi";
    $days[4] = "Jeudi";
    $days[5] = "Vendredi";
    $days[6] = "Samedi";
    echo "<p>The days of the week in French are: $days[0], $days[1], $days[2], $days[3], $days[4], $days[5], $days[6].</p>";
    ?>
</body>

</html>