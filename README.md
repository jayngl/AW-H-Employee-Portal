
AW&H Employee Portal
A PHP-based web application for AW&H employees to securely connect to the company database, view employment details, send emails, execute queries, and update records.

![AW-H-Employee-Portal](https://github.com/user-attachments/assets/8185b6a9-8088-47c3-9793-8ac171f1fca4)


Features:

Secure Login: Employees authenticate using their EIN, username, and database credentials (max 3 attempts).
Employment Details: View current BAN, branch, salary calculations, and highest qualification.
SQL Execution: Run predefined queries or custom SELECT and UPDATE queries on the employee database.
Email Notifications: Send employment details (excluding password) to a specified email.
User Confirmation & Feedback: Ensures successful updates and provides appropriate messages for errors.
Exit Confirmation: Requests user confirmation before disconnecting from the database.
Tech Stack:
> Backend: PHP
> Frontend: HTML, CSS
> Database: MySQL

Installation:

Clone the repository:https://github.com/jayngl/AW-H-Employee-Portal.git

Set up a local server (e.g., XAMPP, WAMP).
Configure database connection in config.php.
Run the application in a web browser.


Usage:

Enter login credentials (EIN, username, database).
Upon successful connection, access available menu options.
Select and execute predefined queries or custom SQL statements.
Send employment details via email if needed.
Confirm before exiting the application.

