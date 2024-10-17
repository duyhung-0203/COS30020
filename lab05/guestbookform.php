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
    <hr>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend><b>Enter your details to sign our guest book</b></legend>
        <p>
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" novalidate />
        </p>
        <p>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" novalidate />
        </p>
        <input type="submit" value="Submit" />
        </fieldset>
    </form>
    <p><a href="guestbookshow.php">Show Guest Book</a></p>
</body>

</html>