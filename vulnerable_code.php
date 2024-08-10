<?php
// Vulnerable PHP code with SQL Injection, Command Injection, and XSS

// SQL Injection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; // SQL Injection vulnerability
$sql = "SELECT * FROM users WHERE id = $id"; // Unsafe query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

// Command Injection
$command = $_GET['command']; // Command Injection vulnerability
$output = shell_exec($command); // Unsafe command execution
echo "<pre>$output</pre>";

// XSS (Cross-Site Scripting)
$message = $_GET['message']; // XSS vulnerability
echo "<div>Your message: " . $message . "</div>"; // Unsafe output

?>
