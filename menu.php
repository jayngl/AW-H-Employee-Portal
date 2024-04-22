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