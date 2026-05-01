<?php
include "employee_db.php";

// Function to insert employee
function insertEmployee($conn, $name, $salary, $department) {
    $sql = "INSERT INTO employees (name, salary, department) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sds", $name, $salary, $department);
    return mysqli_stmt_execute($stmt);
}

// Function to delete employee
function deleteEmployee($conn, $id) {
    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// Insert operation
if (isset($_POST['insert'])) {
    $name = trim($_POST['name']);
    $salary = trim($_POST['salary']);
    $department = trim($_POST['department']);

    if (!empty($name) && !empty($salary) && !empty($department)) {
        insertEmployee($conn, $name, $salary, $department);
    }

    header("Location: employee_index.php");
    exit();
}

// Delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    deleteEmployee($conn, $id);

    header("Location: employee_index.php");
    exit();
}

// Read operation
$result = mysqli_query($conn, "SELECT * FROM employees");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee CRUD Application</title>
    <link rel="stylesheet" href="employee_style.css">
</head>

<body>

<div class="container">

    <h2>Employee CRUD Operations</h2>

    <p class="status">
        <?php echo $_SESSION['login_status']; ?>
    </p>

    <form method="POST">

        <label>Employee Name:</label>
        <input type="text" name="name" placeholder="Enter employee name" required>

        <label>Salary:</label>
        <input type="number" step="0.01" name="salary" placeholder="Enter salary" required>

        <label>Department:</label>
        <input type="text" name="department" placeholder="Enter department" required>

        <button type="submit" name="insert">Add Employee</button>

    </form>

    <h3>Employee Records</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['salary']); ?></td>
            <td><?php echo htmlspecialchars($row['department']); ?></td>
            <td>
                <a class="edit" href="employee_edit.php?id=<?php echo $row['id']; ?>">Edit</a>

                <a class="delete"
                   href="employee_index.php?delete=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this employee?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>