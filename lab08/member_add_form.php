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
    <h1>Member Add page</h1>
    <form action="member_add.php" method="post">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname" novalidate/>
        <br />
        <br />
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" novalidate />
        <br />
        <br />
        <label for="gender" novalidate>Gender: </label>
        <input type="radio" name="gender" id="gender" value="M"/>M
        <input type="radio" name="gender" id="gender" value="F"/>F
        <br />
        <br />
        <label for="email">Email: </label>
        <input type="text" name="email" id="email" novalidate/>
        <br />
        <br />
        <label for="phone">Phone: </label>
        <input type="text" name="phone" id="phone" novalidate/>
        <br />
        <br />
        <input type="submit" value="Add Member" />
        <input type="reset" value="Clear" />
    </form>
</body>

</html>