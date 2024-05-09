<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "aenzbi_restaurant_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL injection protection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Start session
        session_start();

        // Set session variables
        $_SESSION['username'] = $username;

        // Redirect to dashboard or home page
        header("location: dashboard.php");
    } else {
        // Invalid credentials, redirect back to login page with an error message
        header("location: login.html?error=invalid_credentials");
    }
}

$conn->close();
?>
