<?php
session_start();

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//email configuration file
require 'email2.php'; 

// Check if user is logged in
if (!isset($_SESSION["user"])) {
    // Redirect to login page if user is not logged in
    header("Location: MajorProjectLogin.php");
    exit;
}

// Database credentials
$host = "localhost";
$database_name = "Employees";
$username = "root";
$password = "@Mysql123";

// Create database connection
$connection = new mysqli($host, $username, $password, $database_name);

// Check connection
if ($connection->connect_error) {
    die("Could not connect to database: " . $connection->connect_error);
}

try {
    // Fetch logged-in user's EIN from session
    $loggedInUserEIN = $_SESSION['EIN'];

    // Query to fetch employee details for the logged-in user
    $query = "SELECT Employee_name, Current_highest_qualification, Salary, Deductions, TRN, Bank_branch FROM employee_info WHERE EIN = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $loggedInUserEIN);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $employeeDetails = $result->fetch_assoc();

            // Construct email message
            $recipientEmail = 'dalmagedanique07@gmail.com'; // Specific recipient email address 
            $subject = "Employee Details for {$employeeDetails['Employee_name']}";
            $message = "Employee Name: {$employeeDetails['Employee_name']}\n";
            $message .= "Highest Qualification: {$employeeDetails['Current_highest_qualification']}\n";
            $message .= "Salary: {$employeeDetails['Salary']}\n";
            $message .= "Deductions: {$employeeDetails['Deductions']}\n";
            $message .= "Tax Registration Number: {$employeeDetails['TRN']}\n";
            $message .= "Bank Branch: {$employeeDetails['Bank_branch']}\n";

            // Send email using PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = MAILHOST;
            $mail->SMTPAuth = true;
            $mail->Username = USERNAME;
            $mail->Password = PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(SEND_FROM, SEND_FROM_NAME);
            $mail->addAddress($recipientEmail);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            echo "Email sent successfully.";
        } else {
            echo "Employee details not found for the logged-in user.";
        }
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    // Close prepared statement
    $stmt->close();
} catch (Exception $e) {
    echo "Failed to send email. Error: {$e->getMessage()}";
}

// Close database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sending Result</title>
</head>
<body>
    <h3>Details:</h3>
    <p><?php echo $message; ?></p>

    <!-- Button to return to home page -->
    <form action="Index.php" method="get">
        <button type="submit">Return to Home</button>
    </form>
</body>
</html>