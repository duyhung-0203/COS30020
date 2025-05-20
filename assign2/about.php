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

    <!-- Navigation bar -->
    <nav>
        <ul class="list">
            <!-- Links to different sections of the system -->
            <li class="content"><a class="btn" href="index.php">Home</a></li>
            <li class="content"><a class="btn" href="friendadd.php">Add Friend</a></li>
            <li class="content"><a class="btn" href="friendlist.php">Friend List</a></li>
        </ul>
    </nav>
    <h2>Home Page</h2>
    <!-- Section for displaying user information -->
    <!-- Information section that answers the assignment requirements -->
    <div class="information">
        <!-- Row for answering the first set of assignment questions -->
        <div class="row">
            <div class="task">
                Req 1: List your answers in bullet point for each question. The requirements are as follows:
                <!-- Question 1 -->
                <div class="question">
                    1. What tasks you have not attempted or not completed?
                </div>
                <!-- Answer using PHP's built-in version function -->
                <div class="answer">
                    Basically, I have completed almost all the tasks in this Assignment 2, except for validating all the
                    PHP
                    files.
                </div>

                <!-- Question 2 -->
                <div class="question">
                    2. What special features have you done, or attempted, in creating the site that we should know
                    about?
                </div>
                <div class="answer">
                    I have done all the tasks as required. I have also added a footer to the website. I have also added
                    a hover effect to the buttons in the navigation bar. <!-- Your answer for this task -->
                </div>

                <!-- Question 3 -->
                <div class="question">
                    3. Which parts did you have trouble with?
                </div>
                <div class="answer">
                    I found the Friend Add and Friend List pages to be the most challenging because these two pages
                    involve
                    the most work with the database. During initialization, I encountered many issues, such as SQL not
                    updating, being unable to save the friend ID, or buttons not functioning correctly.
                </div>

                <!-- Question 4 -->
                <div class="question">
                    4. What would you like to do better next time?
                </div>
                <div class="answer">
                    In the future, I hope I can improve my validate HTML skills. Additionally, good interface design
                    would
                    get me much better. <!-- Your answer for this task -->
                </div>

                <!-- Question 5 -->
                <div class="question">
                    5. What additional features did you add to the assignment? (if any)
                </div>
                <div class="answer">
                    I add some basic requirement in setup password with at least 8 characters or the legend of the table
                    in
                    List Friend. <!-- Your answer for this task -->
                </div>
            </div>
        </div>

        <!-- Row for answering the second set of assignment questions -->
        <div class="row">
            <div class="task">
                Req 2: Provide a screen shot for the following
                <!-- Question 1 -->
                <div class="question">
                    1. A screen shot of a discussion response that answered someone’s thread in the unit’s
                    discussion board for Assignment 2?
                </div>
                <div class="answer">
                    I did not have any exchanges or questions with anyone on the discussion board for Assignment 2.
                    Because I find Assignment 2 not too difficult and the requirements are still manageable for me, I
                    don't see the need for discussion at this point. Perhaps for Q&A about Assignment 2, I will consider
                    using it.
                </div>

                <!-- Image for the discussion board -->
                <div class="image">
                    <img src="images/img.png" alt="Discussion Board"> <!-- Screenshot of your discussion board -->
                </div>
            </div>
        </div>
    </div>

    <!-- Footer section -->
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