<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Do Duy Hung" />
    <title>TITLE</title>
</head>

<body>
    <h1>Web Programming Form - Lab 5</h1>
    <form action="shoppingsave.php"method="post">
        <label for="item">Item:</label>
        <input type="text" name="item" id="item" novalidate/>
        <br />
        <br />
        <label for="qty">Quantity:</label>
        <input type="text" name="qty" id="qty" novalidate />
        <br />
        <br />
        <input type="submit" value="Submit" />
    </form>
</body>

</html>