<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AW&H Portal</title>
    <?php include 'menu.php'; ?>
</head>
<body>

<h1>AW&H Employee Portal</h1>




<p>Mock Introductory Paragraph</p>

<?php
session_start();

// Check if the database connection is stored in the session
if (isset($_SESSION["db_connection"])) {
    $connection = $_SESSION["db_connection"];

} else {
    // Handle the case where $_SESSION["db_connection"] is not set
    echo "Database connection not found in session. Please log in.";
}
?>

</body>
</html>
