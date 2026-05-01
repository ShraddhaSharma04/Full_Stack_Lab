<?php
include "employee_db.php";

// Function to update employee
function updateEmployee($conn, $id, $name, $salary, $department) {
    $sql = "UPDATE employees SET name = ?, salary = ?, department = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdsi", $name, $salary, $department, $id);
    return mysqli_stmt_execute($stmt);
}

if (!isset($_GET['id'])) {
    header("Location: employee_index.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM employees WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: employee_index.php");
    exit();
}

// Update operation
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $salary = trim($_POST['salary']);
    $department = trim($_POST['department']);

    if (!empty($name) && !empty($salary) && !empty($department)) {
        updateEmployee($conn, $id, $name, $salary, $department);
    }

    header("Location: employee_index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Employee</title>
    <link rel="stylesheet" href="employee_style.css">
</head>

<body>

<div class="container">

    <h2>Update Employee Details</h2>

    <p class="status">
        <?php echo $_SESSION['login_status']; ?>
    </p>

    <form method="POST">

        <label>Employee Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

        <label>Salary:</label>
        <input type="number" step="0.01" name="salary" value="<?php echo htmlspecialchars($row['salary']); ?>" required>

        <label>Department:</label>
        <input type="text" name="department" value="<?php echo htmlspecialchars($row['department']); ?>" required>

        <button type="submit" name="update">Update Employee</button>

    </form>

    <a class="back" href="employee_index.php">Back to Home</a>

</div>

</body>
</html>