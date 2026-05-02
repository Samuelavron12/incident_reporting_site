<?php
echo "<h1>Database Connection Test</h1>";
echo "<hr>";

// Configuration
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "smart_traffic_db";
$port = 3307;

// Test 1: Can we connect to MySQL server at all?
echo "<strong>Test 1: Connecting to MySQL Server</strong><br>";
$connection = mysqli_connect($host, $user, $password, '', $port);

if (!$connection) {
    echo "Cannot connect to MySQL server on port $port<br>";
    echo "Error: " . mysqli_connect_error() . "<br><br>";
    echo "<strong>Possible solutions:</strong><br>";
    echo "- Check if MySQL is running on port 3307<br>";
    echo "- Try changing port to 3306 (default)<br>";
    echo "- Check if XAMPP/WAMP/MAMP is running<br>";
    die("Test stopped.");
} else {
    echo "Successfully connected to MySQL server on port $port<br><br>";
}

// Test 2: Check if database exists
echo "<strong>Test 2: Checking database '$database'</strong><br>";
$db_selected = mysqli_select_db($connection, $database);

if (!$db_selected) {
    echo "Database '$database' does not exist<br>";
    echo "Error: " . mysqli_error($connection) . "<br><br>";
    
    // List available databases
    echo "<strong>Available databases on this server:</strong><br>";
    $result = mysqli_query($connection, "SHOW DATABASES");
    while ($row = mysqli_fetch_array($result)) {
        echo "- " . $row[0] . "<br>";
    }
} else {
    echo "Database '$database' exists<br><br>";
}

// Test 3: List tables (if database exists)
if ($db_selected) {
    echo "<strong>Test 3: Listing tables in '$database'</strong><br>";
    $result = mysqli_query($connection, "SHOW TABLES");
    
    if (mysqli_num_rows($result) > 0) {
        echo "Found " . mysqli_num_rows($result) . " table(s):<br>";
        while ($row = mysqli_fetch_array($result)) {
            echo "- " . $row[0] . "<br>";
        }
    } else {
        echo "Database exists but has no tables yet<br>";
    }
    echo "<br>";
}

// Close connection
mysqli_close($connection);
echo "Connection closed.<br>";
?>