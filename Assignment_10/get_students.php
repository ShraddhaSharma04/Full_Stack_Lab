<?php
header("Content-Type: application/json");

$file = "students.json";

if (!file_exists($file)) {
    echo json_encode([
        "status" => "success",
        "message" => "No records found.",
        "students" => []
    ]);
    exit;
}

$jsonData = file_get_contents($file);

if ($jsonData === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Unable to read students.json file.",
        "students" => []
    ]);
    exit;
}

$students = json_decode($jsonData, true);

if (!is_array($students)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON format in students.json.",
        "students" => []
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "message" => "Students fetched successfully.",
    "students" => $students
]);
?>