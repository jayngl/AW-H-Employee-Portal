<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="database_query.css">
    <link rel="icon" href="court.png">
    <title>Database Query Form</title>


    
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
<center>


<form method="post" action="process_query.php" onsubmit="return validateForm()">
<h1>Database Query Form</h1>
    <label for="action">Select Database Action:</label>
    <select id="action" name="action" onchange="handleActionChange()">
        <option value="">-- Select Action --</option> <!-- Default option not selected. Spaceholder-->
        <option value="SELECT">SELECT</option>
        <option value="UPDATE">UPDATE</option>
    </select>

    <br><br>

    <label for="field">Select Database Field:</label>
<select id="field" name="field">
    <!-- Default field option prompting user to select a field -->
    <option value="" selected disabled>-- Select Field --</option>
    </select>

    <br><br>
        <!-- Accept new value for update query -->
    <div id="newValueContainer" style="display: none;">
        <label for="newValue">Enter New Value:</label>
        <input type="text" id="newValue" name="newValue">
    </div>

    <br><br>

    <input type="submit" value="Execute Query"> <!--When submit button is clicked. Run query-->
</form>

</center>
<script>
function handleActionChange() {
    var actionSelect = document.getElementById("action");
    var fieldSelect = document.getElementById("field");
    var newValueContainer = document.getElementById("newValueContainer");

    // Clear existing options
    fieldSelect.innerHTML = "";

    // Add options based on selected action
    if (actionSelect.value === "SELECT") {
        // Add default option
        var defaultOption = document.createElement("option");
        defaultOption.text = "All Data";
        defaultOption.value = "All Data";
        fieldSelect.add(defaultOption);

        // Add specific database fields as options for select query
        var fields = ["Employee_name", "Current_highest_qualification", "Salary", "Deductions", "TRN", "Bank_branch", "BAN"];
        fields.forEach(function(field) {
            var option = document.createElement("option");
            option.text = field;
            option.value = field;
            fieldSelect.add(option);
        });

        // Hide the new value input for SELECT action. field not valid for this query
        newValueContainer.style.display = "none";
    } else if (actionSelect.value === "UPDATE") {
        // Add database fields as options for UPDATE action
        var fields = ["Employee_name", "Current_highest_qualification",  "TRN", "Bank_branch", "BAN"];
        fields.forEach(function(field) {
            var option = document.createElement("option");
            option.text = field;
            option.value = field;
            fieldSelect.add(option);
        });

        // Show the new value input for UPDATE action
        newValueContainer.style.display = "block";
    }
}

function validateForm() {
    var actionSelect = document.getElementById("action");
    var fieldSelect = document.getElementById("field");
    var newValueInput = document.getElementById("newValue");

    // Validate form based on selected action
    if (actionSelect.value === "UPDATE" && newValueInput.value.trim() === "") {
        alert("Please enter a new value for the selected field.");
        newValueInput.focus();
        return false;
    }

    return true;
}
</script>

</body>
</html>
