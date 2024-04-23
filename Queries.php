
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="queriestyle.css">
    <link rel="icon" href="court.png">
    <title>AW&H Query Menu</title>
    <!-- <?php include 'menu.php'; ?> -->
</head>
<body>

<header class="navbar">

<h1 class="logo" > <img src="court.png" alt=""><a href="index.php">AW&H Employee Portal</a> </h1>
<nav>
        <ul class="nav-links">
            <li><a href="sendingemails.php">Email Us</a></li>
            <li><a href="Queries.php">Create Queries</a></li>
            <li><a href="database_query_form.php">Create SQL Queries</a></li>
        </ul>
    </nav>
</header>
    
    <form class="form" method="post">
    <center><h1>AW&H Query Menu</h1></center>
        <p>Select a query to execute:</p>
        <label><input type="radio" name="queryNumber" value="1"> Show current Bank account number (BAN)</label><br>
        <label><input type="radio" name="queryNumber" value="2"> Show current Bank Branch</label><br>
        <label><input type="radio" name="queryNumber" value="3"> Total monies to be received for net pay</label><br>
        <label><input type="radio" name="queryNumber" value="4"> Show highest qualification</label><br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<br> <br> <br>

<?php
session_start();

// Function to establish database connection
function get_db_connection() {
    $host = "localhost";
    $database_name = "Employees";
    $username = "root";
    $password = "@Mysql123";

    // Create connection
    $connection = new mysqli($host, $username, $password, $database_name);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $connection;
}

// Function to calculate net pay based on employee EIN
function calculate_net_pay($employee_ein) {
    $connection = get_db_connection();

    // SQL query to fget salary and deductions based on EIN
    $query = "SELECT Salary, Deductions FROM employee_info WHERE EIN = '$employee_ein'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $salary = $row['Salary'];
        $deductions = $row['Deductions'];
        $net_pay = $salary - $deductions;
        $connection->close();
        return ['net_pay' => $net_pay, 'salary' => $salary, 'deductions' => $deductions];
    } else {
        $connection->close();
        return "Employee not found.";
    }
}

// Function to retrieve BAN based on session EIN
function get_ban() {
    $connection = get_db_connection();
    $session_ein = $_SESSION["EIN"];

    // Prepare SQL query to fetch highest qualification based on session EIN
    $query = "SELECT BAN FROM employee_info WHERE EIN = '$session_ein'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $connection->close();
        return $row['BAN'];
    } else {
        $connection->close();
        return "Bank account number could not be recovered.";
    }
}

// Function to retrieve Bank Branch based on session EIN
function get_bank_branch() {
    $connection = get_db_connection();
    $session_ein = $_SESSION["EIN"];

    // Prepare SQL query to fetch highest qualification based on session EIN
    $query = "SELECT Bank_Branch FROM employee_info WHERE EIN = '$session_ein'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $connection->close();
        return $row['Bank_Branch'];
    } else {
        $connection->close();
        return "Bank branch could not be recovered.";
    }
}

// Function to retrieve highest qualification based on session EIN
function get_highest_qualification() {
    $connection = get_db_connection();
    $session_ein = $_SESSION["EIN"];

    // Prepare SQL query to fetch highest qualification based on session EIN
    $query = "SELECT Current_highest_qualification FROM employee_info WHERE EIN = '$session_ein'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $connection->close();
        return $row['Current_highest_qualification'];
    } else {
        $connection->close();
        return "No qualifications found.";
    }
}

// Function to execute SQL query
function execute_sql_query($query) {
    $connection = get_db_connection();

    try {
        $connection->query($query);
        $connection->close();
        return "Query executed successfully.";
    } catch (Exception $e) {
        return "Error executing query: " . $e->getMessage();
    }
}

// Function to handle user exit confirmation
function handle_user_exit($confirmation) {
    if ($confirmation === "yes") {
        return "Disconnecting from the database. Goodbye!";
    }
    return "Continuing with the application.";
}

// Execute selected query based on user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['queryNumber'])) {
        $queryNumber = $_POST['queryNumber'];

        switch ($queryNumber) {
            case 1:
                $ban = get_ban();
                echo "Bank Account Number: $ban<br>";
                break;
            case 2:
                echo "Current Bank Branch: Main Branch<br>";
                break;
            case 3:
                $result = calculate_net_pay($_SESSION["EIN"]);
            
                if (isset($result['net_pay'])) {
                    $netPay = $result['net_pay'];
                    $salary = $result['salary'];
                    $deductions = $result['deductions'];
            
                    echo "Total monies to be received for net pay:<br>";
                    echo "Salary: $salary - Deductions: $deductions = Net Pay: $netPay<br>";
                } else {
                    echo "Error: " . $result['error']; // Display error message if calculation fails
                }
                break;
            case 4:
                $highestQualification = get_highest_qualification();
                echo "Highest Qualification: $highestQualification<br>";
                break;
            default:
                echo "Invalid query number!";
        }
    } else {
        echo "Please select a query to execute.";
    }
}
?>

