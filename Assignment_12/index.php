<!DOCTYPE html>
<html>
<head>
    <title>Student Registration System</title>

    <script>
        function validateForm() {
            let name = document.forms["studentForm"]["name"].value;
            let email = document.forms["studentForm"]["email"].value;
            let age = document.forms["studentForm"]["age"].value;
            let course = document.forms["studentForm"]["course"].value;
            let password = document.forms["studentForm"]["password"].value;

            if (name == "" || email == "" || age == "" || course == "" || password == "") {
                alert("All fields are required.");
                return false;
            }

            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                return false;
            }

            if (age < 16 || age > 60) {
                alert("Age must be between 16 and 60.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            return true;
        }
    </script>

    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Student Registration</h2>

    <form name="studentForm" action="register.php" method="POST" onsubmit="return validateForm()">

        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Age:</label>
        <input type="number" name="age" required>

        <label>Course:</label>
        <select name="course" required>
            <option value="">Select Course</option>
            <option value="B.Tech CSE">B.Tech CSE</option>
            <option value="BCA">BCA</option>
            <option value="MCA">MCA</option>
            <option value="B.Sc IT">B.Sc IT</option>
        </select>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>

    </form>
</div>

</body>
</html>