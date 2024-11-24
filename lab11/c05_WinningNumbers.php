<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="description" content="Web application development"/>
    <meta name="keywords" content="PHP"/>
    <meta name="author" content="Do Duy Hung"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Winning Numbers</title>
</head>
<body>
<h1>Winning Numbers</h1>
<hr/>
<?php
$PossibleNumbers = array();
for ($i = 1; $i < 100; ++$i) {
    $PossibleNumbers[] = $i;
}
shuffle($PossibleNumbers);
$WinningNumbers = array_slice($PossibleNumbers, 0, 5);
foreach ($WinningNumbers as $Number) {
    echo "$Number<br />";
}

?>
</body>
</html>
