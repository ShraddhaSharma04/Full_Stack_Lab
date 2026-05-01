<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "student_db";
$port = 3307;

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?><!DOCTYPE html>
<html>
<head>
    <title>Student Registration System</title>
    <link rel="stylesheet" href="style.css">

    <script>
        function validateForm() {
            let name = document.forms["studentForm"]["name"].value.trim();
            let email = document.forms["studentForm"]["email"].value.trim();
            let age = document.forms["studentForm"]["age"].value.trim();
            let course = document.forms["studentForm"]["course"].value;
            let password = document.forms["studentForm"]["password"].value.trim();

            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if (name === "") {
                alert("Name is required");
                return false;
            }

            if (email === "") {
                alert("Email is required");
                return false;
            }

            if (!email.match(emailPattern)) {
                alert("Enter a valid email address");
                return false;
            }

            if (age === "") {
                alert("Age is required");
                return false;
            }

            if (age <= 0) {
                alert("Age must be greater than 0");
                return false;
            }

            if (course === "") {
                alert("Please select a course");
                return false;
            }

            if (password === "") {
                alert("Password is required");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>

<div class="container">
    <h2>Student Registration</h2>

    <?php
    if (isset($_GET['error'])) {
        echo "<div class='error'>" . htmlspecialchars($_GET['error']) . "</div>";
    }
    ?>

    <form name="studentForm" method="POST" action="register.php" onsubmit="return validateForm()">

        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter student name" required>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Enter email" required>

        <label>Age:</label>
        <input type="number" name="age" placeholder="Enter age" required>

        <label>Course:</label>
        <select name="course" required>
            <option value="">Select Course</option>
            <option value="B.Tech CSE">B.Tech CSE</option>
            <option value="BCA">BCA</option>
            <option value="MCA">MCA</option>
            <option value="B.Sc IT">B.Sc IT</option>
            <option value="M.Tech">M.Tech</option>
        </select>

        <label>Password:</label>
        <input type="password" name="password" placeholder="Enter password" required>

        <button type="submit">Register</button>

    </form>
</div>

</body>
</html>