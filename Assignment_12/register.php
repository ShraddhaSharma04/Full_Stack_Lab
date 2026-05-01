<?php
require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);
    $course = trim($_POST["course"]);
    $password = trim($_POST["password"]);

    // Server-side validation
    if (empty($name)) {
        header("Location: index.php?error=Name is required");
        exit();
    }

    if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=Invalid email format");
        exit();
    }

    if (empty($age)) {
        header("Location: index.php?error=Age is required");
        exit();
    } elseif (!is_numeric($age) || $age <= 0) {
        header("Location: index.php?error=Age must be a valid positive number");
        exit();
    }

    if (empty($course)) {
        header("Location: index.php?error=Course is required");
        exit();
    }

    if (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } elseif (strlen($password) < 6) {
        header("Location: index.php?error=Password must be at least 6 characters");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO students (name, email, age, course, password)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiss", $name, $email, $age, $course, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Registration Successful</title>
            <link rel="stylesheet" href="style.css">
        </head>

        <body>

        <div class="box">
            <h2 class="success">Registration Successful</h2>

            <p><b>Name:</b> <?php echo htmlspecialchars($name); ?></p>
            <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>
            <p><b>Age:</b> <?php echo htmlspecialchars($age); ?></p>
            <p><b>Course:</b> <?php echo htmlspecialchars($course); ?></p>

            <a href="index.php">Register Another Student</a>
        </div>

        </body>
        </html>
        <?php
        exit();
    } else {
        header("Location: index.php?error=Data not inserted");
        exit();
    }
}
?>