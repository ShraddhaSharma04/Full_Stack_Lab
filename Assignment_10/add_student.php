<?php
header("Content-Type: application/json");

$file = "students.json";

$name = isset($_POST["name"]) ? trim($_POST["name"]) : "";
$marks = isset($_POST["marks"]) ? trim($_POST["marks"]) : "";

if ($name === "" || $marks === "") {
    echo json_encode([
        "status" => "error",
        "message" => "Name and marks are required."
    ]);
    exit;
}

if (!is_numeric($marks) || $marks < 0 || $marks > 100) {
    echo json_encode([
        "status" => "error",
        "message" => "Marks must be a number between 0 and 100."
    ]);
    exit;
}

if (!file_exists($file)) {
    $created = file_put_contents($file, "[]");

    if ($created === false) {
        echo json_encode([
            "status" => "error",
            "message" => "Unable to create students.json file."
        ]);
        exit;
    }
}

$jsonData = file_get_contents($file);

if ($jsonData === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to read students.json file."
    ]);
    exit;
}

$students = json_decode($jsonData, true);

if (!is_array($students)) {
    $students = [];
}

$newStudent = [
    "name" => htmlspecialchars($name),
    "marks" => (int)$marks
];

$students[] = $newStudent;

$saved = file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT));

if ($saved === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to save student record."
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "Student added successfully.",
    "students" => $students
]);
?>