<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $field = $_POST["field"];

    // Database credentials
    $host = "localhost";
    $database_name = "Employees";
    $username = "root";
    $password = "";

    // Create database connection
    $connection = new mysqli($host, $username, $password, $database_name);

    // Check connection
    if ($connection->connect_error) {
        die("Could not connect to database: " . $connection->connect_error);
    }

    if ($action === "SELECT") {
        $query = ($field === "All") ? "SELECT * FROM employee_info" : "SELECT $field FROM employee_info";
    } elseif ($action === "UPDATE") {
        $newValue = $_POST["newValue"];
        $query = "UPDATE employee_info SET $field = '$newValue'";
    }

    // Execute the SQL query
    $result = $connection->query($query);

    if ($result === true) {
        echo "Query executed successfully.";
    } else {
        echo "Error executing query: " . $connection->error;
    }

    // Close database connection
    $connection->close();
} else {
    echo "Invalid request.";
}
?>
