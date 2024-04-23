<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    if (isset($_POST["action"], $_POST["field"])) {
        $action = strtoupper($_POST["action"]); 
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

        // Validate the action selection
        if (!in_array($action, ['SELECT', 'UPDATE'])) {
            echo "Invalid action specified.";
            $connection->close();
            exit;
        }

        // Validate the field against allowed options
        $allowedFields = ['Employee_name', 'Current_highest_qualification', 'Salary', 'Deductions', 'TRN', 'Bank_branch', 'BAN'];
        if (!in_array($field, $allowedFields) && $field !== "All Data") {
            echo "Invalid field specified.";
            $connection->close();
            exit;
        }

        if ($action === "SELECT") {
            // Prepare SELECT query based on field and logged-in user's EIN
            $session_ein = $_SESSION["EIN"];
            if ($field === "All Data") {
                $query = "SELECT * FROM employee_info WHERE EIN = ?";
            } else {
                // Construct the SELECT query based on the selected field and EIN
                $query = "SELECT $field FROM employee_info WHERE EIN = ?";
            }

            // Execute SELECT query with prepared statement
            $stmt = $connection->prepare($query);
            if ($stmt) {
                $stmt->bind_param("s", $session_ein); // Bind EIN as integer parameter
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    //if results are not empty
                    if ($result->num_rows > 0) {
                        // Output results
                        echo "<h2>Query Results:</h2>";
                        while ($row = $result->fetch_assoc()) {
                            if ($field === "All Data") {
                                // Output all data in a custom format
                                echo "<p>Employee Name: {$row['Employee_name']}</p>";
                                echo "<p>Qualification: {$row['Current_highest_qualification']}</p>";
                                echo "<p>Salary: {$row['Salary']}</p>";
                                echo "<p>Deductions: {$row['Deductions']}</p>";
                                echo "<p>TRN: {$row['TRN']}</p>";
                                echo "<p>Bank Branch: {$row['Bank_branch']}</p>";
                                echo "<p>BAN: {$row['BAN']}</p>";
                            } else {
                                // Output the selected field
                                echo "<p>{$field}: {$row[$field]}</p>";
                            }
                        }
                    } else {
                        echo "No records found for the specified criteria.";
                    }
                } else {
                    echo "Error executing SELECT query: " . $stmt->error;
                }
                $stmt->close(); // Close prepared statement
            } else {
                echo "Error preparing SELECT statement: " . $connection->error;
            }
        }  elseif ($action === "UPDATE") {
            // Process UPDATE action
            $newValue = $_POST["newValue"];
            $session_ein = $_SESSION["EIN"];

            // Validate new value (you may want to add more specific validation)
            if (empty($newValue)) {
                echo "Please provide a new value for the selected field.";
                $connection->close();
                exit;
            }

            // Construct the UPDATE query based on the selected field and EIN
            $query = "UPDATE employee_info SET $field = ? WHERE EIN = ?";
            
            // Execute UPDATE query with prepared statement
            $stmt = $connection->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ss", $newValue, $session_ein); // Bind parameters
                if ($stmt->execute()) {
                    echo "Update successful. New value for $field: $newValue";
                } else {
                    echo "Error executing UPDATE query: " . $stmt->error;
                }
                $stmt->close(); // Close prepared statement
            } else {
                echo "Error preparing UPDATE statement: " . $connection->error;
            }
        }

        // Close database connection
        $connection->close();// Back button to return to the form page
        echo '<br><button onclick="goBack()">Go Back</button>';
    } else {
        echo "Invalid input parameters.";
    }
} else {
    echo "Invalid request method.";
}

// JavaScript function to navigate back to the previous page
echo '
<script>
function goBack() {
    window.history.back(); // Go back to the previous page
}
</script>
';
?>
