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
    <h1>Web Programming - Lab06</h1>
    <?php
if (isset($_POST["item"]) && isset($_POST["qty"]) && !empty($_POST["item"]) && !empty($_POST["qty"])) {
    $item = $_POST["item"]; // obtain the form item data
    $qty = $_POST["qty"]; // obtain the form quantity data

    // Check if the quantity is a positive integer
    if (is_numeric($qty) && $qty > 0 && $qty == round($qty)) {
        $filename = "../../data/shop.txt"; // assumes php file is inside lab06
        $alldata = array(); // create an empty array

        // Check if the file exists and process existing data
        if (file_exists($filename)) {
            $itemdata = array(); // create an empty array
            $handle = fopen($filename, "r"); // open the file in read mode

            if ($handle) { // ensure file opened successfully
                while (!feof($handle)) { // loop while not end of file
                    $onedata = fgets($handle); // read a line from the text file
                    if ($onedata != "") { // ignore blank lines
                        $data = explode(",", $onedata); // explode string to array
                        $alldata[] = $data; // create an array element
                        $itemdata[] = $data[0]; // create a string element
                    }
                }
                fclose($handle); // close the text file
                $newdata = !(in_array($item, $itemdata)); // check if item exists in array
            } else {
                echo "<p>Error: Unable to open file for reading.</p>";
                exit;
            }
            
        } else {
            $newdata = true; // file does not exist, thus it must be a new data
        }

        // Check if it's new data and append if needed
        if ($newdata) {
            $handle = fopen($filename, "a"); // open the file in append mode
            if ($handle) { // ensure file opened successfully
                $data = $item . "," . $qty . "\n"; // concatenate item and qty delimited by comma
                fputs($handle, $data); // write string to text file
                fclose($handle); // close the text file
                $alldata[] = array($item, $qty); // add data to array
                echo "<p>Shopping item added</p>";
            } else {
                echo "<p>Error: Unable to open file for writing.</p>";
                exit;
            }
        } else {
            echo "<p>Shopping item already exists</p>";
        }

        // Display sorted shopping list
        sort($alldata); // sort array elements
        echo "<p>Shopping List</p>";
        foreach ($alldata as $data) {
            echo "<p>", $data[0], " -- ", $data[1], "</p>";
        }
    } else {
        // If quantity is not a positive integer, show this message
        echo "<p>The quantity should be a positive integer.</p>";
    }
} else {
    echo "<p>Please enter item and quantity in the input form.</p>";
}
?>


</body>

</html>