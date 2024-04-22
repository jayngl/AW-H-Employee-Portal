<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AW&H Portal</title>
</head>
<body>

<h1>AW&H Employee Portal</h1>
<h3>What would you like to do today?</h3>

<nav>
    <a href="sendingemails.php">Send Email with Employment Details</a>
    <a href="Queries.php">Execute Select Queries</a>
    <a href="custom_sql.php">Specify Custom SQL Query</a>

<button onclick="confirmLogout()">Logout</button>

<script>
function confirmLogout() {
    let confirmationText = "Are you sure you want to logout?";
    if (confirm(confirmationText)) {
        //  if user clicked OK in the confirmation dialog
        // Perform the logout action 
        window.location.href = "MajorProjectLogout.php";
    } 
}
</script>


</nav>

<p>Mock Introductory Paragraph</p>

<?php
session_start();

// Check if the database connection is stored in the session
if (isset($_SESSION["db_connection"])) {
    $connection = $_SESSION["db_connection"];

    // You can use $connection here for database operations
} else {
    // Handle the case where $_SESSION["db_connection"] is not set
    echo "Database connection not found in session. Please log in.";
}
?>

</body>
</html>
