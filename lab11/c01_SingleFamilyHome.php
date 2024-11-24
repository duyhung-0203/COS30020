<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Do Duy Hung" />
    <title>Output Directive</title>
</head>

<body>
    <?php
    $SingleFamilyHome = 399500;
    $SingleFamilyHome_Print = number_format($SingleFamilyHome);
    echo "<p>The current median price of a single family home in Pleasanton, CA is $$SingleFamilyHome_Print.</p>";
    ?>
</body>

</html>