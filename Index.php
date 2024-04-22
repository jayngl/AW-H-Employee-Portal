<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexstyle.css">
    <link rel="icon" href="court.png">
    <title>AW&H Portal</title>
</head>
<body>

<header class="navbar">

    <h1 class="logo" > <img src="court.png" alt="">AW&H Employee Portal </h1>
    <nav>
        <ul class="nav-links">
            <li><a href="sendingemails.php">Send Email</a></li>
            <li><a href="Queries.php">Execute Queries</a></li>
            <li><a href="custom_sql.php">SQL Query</a></li>
            <li><button onclick="confirmLogout()">Logout</button></li>
        </ul>
    </nav>
</header>
<section class="hero">
    <div class="hero-content">
        <h2>Welcome to AW&H Employee Portal</h2>
        <hr>
        <p>Welcome to Arkwright, Wyndham & Huxley, 
            where legal excellence meets unwavering dedication. 
            With a rich history spanning decades, 
            our esteemed firm has been a cornerstone in providing 
            exceptional legal services to our clients. At Arkwright, Wyndham & Huxley, 
            we pride ourselves on our commitment to integrity, professionalism, 
            and delivering optimal outcomes for every case we undertake.</p>
    </div>
</section>

<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 Arkwright, Wyndham & Huxley. All rights reserved.</p>
        <ul class="footer-links">
            <li><a href="#">Terms of Service</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
    </div>
</footer>


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
