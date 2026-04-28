<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);
    $course = trim($_POST["course"]);
    $password = trim($_POST["password"]);

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($age)) {
        $errors[] = "Age is required.";
    } elseif ($age < 16 || $age > 60) {
        $errors[] = "Age must be between 16 and 60.";
    }

    if (empty($course)) {
        $errors[] = "Course is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    if (!empty($errors)) {
        echo "<h2>Invalid Input</h2>";
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='index.php'>Go Back</a>";
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (name, email, age, course, password) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ssiss", $name, $email, $age, $course, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: success.php?name=$name&email=$email&age=$age&course=$course");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>