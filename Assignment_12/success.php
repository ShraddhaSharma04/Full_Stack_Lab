<?php
$name = $_GET["name"];
$email = $_GET["email"];
$age = $_GET["age"];
$course = $_GET["course"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
        }

        .box {
            width: 400px;
            margin: 50px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        h2 {
            color: green;
            text-align: center;
        }

        p {
            font-size: 16px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Registration Successful</h2>

    <p><b>Name:</b> <?php echo htmlspecialchars($name); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($email); ?></p>
    <p><b>Age:</b> <?php echo htmlspecialchars($age); ?></p>
    <p><b>Course:</b> <?php echo htmlspecialchars($course); ?></p>

    <a href="index.php">Register Another Student</a>
</div>

</body>
</html>