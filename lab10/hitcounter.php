<?php
class HitCounter
{
    private $dbConnect;

    // Constructor to initialize the database connection
    function __construct($host, $username, $password, $dbname)
    {
        // Establish connection to the database
        $this->dbConnect = new mysqli($host, $username, $password, $dbname);

        // Check if the connection was successful
        if ($this->dbConnect->connect_error)
            die("<p>Unable to connect to the database server.</p>"
                . "<p>Error code " . $this->dbConnect->connect_errno
                . ": " . $this->dbConnect->connect_error . "</p>");

        // Check if the 'hitcounter' table exists in the database
        $table = "hitcounter";
        $sql = "SELECT * FROM $table;";
        $this->dbConnect->query($sql)
        or die("<p>Unable to execute the query.</p>"
            . "<p>Error code " . $this->dbConnect->errno
            . ": " . $this->dbConnect->error . "</p>");
    }

    // Function to get the current number of hits from the 'hitcounter' table
    function getHits()
    {
        // SQL query to select the current hit count
        $sql = "SELECT * FROM hitcounter;";
        $this->dbConnect->query($sql)
        or die("<p>Unable to execute the query.</p>"
            . "<p>Error code " . $this->dbConnect->errno
            . ": " . $this->dbConnect->error . "</p>");

        // Execute the query and fetch the result
        $result = $this->dbConnect->query($sql);
        $row = $result->fetch_assoc();

        // Return the 'hits' value from the result
        return $row["hits"];
    }

    // Function to update the hit count in the 'hitcounter' table
    function setHits($hit)
    {
        // SQL query to update the hit count to the specified value
        $sql = "UPDATE hitcounter SET hits = $hit;";
        $this->dbConnect->query($sql)
        or die("<p>Unable to execute the query.</p>"
            . "<p>Error code " . $this->dbConnect->errno
            . ": " . $this->dbConnect->error . "</p>");
    }

    // Function to close the database connection
    function closeConnection()
    {
        if ($this->dbConnect && !$this->dbConnect->connect_error) {
            $this->dbConnect->close();
            $this->dbConnect = null;
        }
    }

    // Function to reset the hit count back to zero
    function startOver()
    {
        $sql = "UPDATE hitcounter SET hits = 0;";
        $this->dbConnect->query($sql)
        or die("<p>Unable to execute the query.</p>"
            . "<p>Error code " . $this->dbConnect->errno
            . ": " . $this->dbConnect->error . "</p>");

        // Debugging statement to confirm reset
        $result = $this->dbConnect->query("SELECT hits FROM hitcounter WHERE id = 1;");
        $row = $result->fetch_assoc();
        echo "<p>Hits after reset: " . $row['hits'] . "</p>";
    }

    // Destructor to close the database connection
    function __destruct()
    {
        $this->closeConnection();
    }
}
?>
