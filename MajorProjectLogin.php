<?php
session_start();

// Initialize login attempt counter in session
if (!isset($_SESSION["login_attempts"])) {
    $_SESSION["login_attempts"] = 0;
}

// Check if the maximum number of login attempts (3) has been reached
if ($_SESSION["login_attempts"] >= 3) {
    // Display a message and prevent further login attempts
    echo "Maximum login attempts exceeded. Please try again later or contact admin for help.";
    exit; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
    $tempNAME = $_POST["username"];
    $tempPASSWORD = $_POST["password"];

    // Database credentials
    $host = "localhost";
    $database_name = "Employees";
    $username = "root";
    $password = "@Mysql123";

    // Connect to database
    $connection = mysqli_connect($host, $username, $password, $database_name);

    // Check connection
    if (mysqli_connect_errno()) {
        die("Could not connect to database");
    }

 // Store the database connection in session for reuse
 $_SESSION["db_connection"] = $connection;

    // Prepare SQL statement to retrieve user from database
    $sql = "SELECT * FROM employee_info WHERE Employee_name = ? AND EIN = ?";
    $stmt = $connection->prepare($sql);

    // Bind parameters and execute prepared statement
    $stmt->bind_param("ss", $tempNAME, $tempPASSWORD);
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();
    
    $userDetails = $result->fetch_assoc();

    // Check if user exists in the database
    if ($result->num_rows > 0) {
        // User found, initialize session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["user"] = $tempNAME;
        $_SESSION["log_in_time"] = time();

         // Fetch and store EIN in session
         $_SESSION["EIN"] = $userDetails["EIN"];

         // Reset login attempt count
         $_SESSION["login_attempts"] = 0;

        // Redirect to home page after successful login
        header("Location: Index.php");
        exit; // Stop further script execution
    }
    else {
        // Invalid credentials, increment login attempts
        $_SESSION["login_attempts"]++;
        $attempts_left = 3 - $_SESSION["login_attempts"];
        echo "Invalid username or password. Attempts left: " . $attempts_left;
        echo '<br><br><form action="MajorProjectLogin.php" method="get"><input type="submit" value="Try Again"></form>';
        exit;
    }
    
    $stmt->close();
// Close database connection
$connection->close();
 
}
}  
?>

<html>
<body>
    <form action="" method="post"> 
        Enter your username (First and Last name): <input name="username" type="text">
        <br>
        Enter your password (EIN): <input name="password" type="password">
        <br>
        <input type="submit" value="Log In">
    </form>
</body>
</html>
